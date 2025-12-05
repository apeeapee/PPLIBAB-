<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ProductRankingExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $limit;
    protected $category;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $limit = $this->request->get('limit', 50);
        $category = $this->request->get('category', null);
        $search = $this->request->get('search', null);
        $sort = $this->request->get('sort', 'rating_desc');
        
        $query = Product::select(
                'products.id',
                'products.name',
                'products.price',
                'products.stock',
                'products.image_url',
                'products.category_slug',
                'products.seller_id',
                'sellers.nama_toko',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.stock', 'products.image_url', 'products.category_slug', 'products.seller_id', 'sellers.nama_toko');

        // Filter by category
        if ($category) {
            $query->where('products.category_slug', $category);
        }

        // Filter by search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('sellers.nama_toko', 'like', "%{$search}%");
            });
        }

        // Sorting
        switch ($sort) {
            case 'rating_asc':
                $query->orderBy('avg_rating', 'asc')->orderBy('review_count', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('products.name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('products.name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('products.price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('products.price', 'desc');
                break;
            default: // rating_desc
                $query->orderBy('avg_rating', 'desc')->orderBy('review_count', 'desc');
                break;
        }

        return $query->limit($limit)->get();
    }

    public function headings(): array
    {
        return [
            'Rank',
            'Nama Produk',
            'Toko',
            'Rating',
            'Jumlah Review',
            'Stok',
            'Harga'
        ];
    }

    public function map($product): array
    {
        static $rank = 0;
        $rank++;

        return [
            $rank,
            $product->name,
            $product->nama_toko,
            number_format($product->avg_rating, 2),
            $product->review_count,
            $product->stock,
            'Rp ' . number_format($product->price, 0, ',', '.')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
