<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class SellersByLocationExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        // Hardcode group by provinsi
        $groupBy = 'provinsi';
        
        return Seller::select($groupBy, DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull($groupBy)
            ->groupBy($groupBy)
            ->orderBy('total', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Provinsi',
            'Jumlah Penjual',
            'Persentase'
        ];
    }

    public function map($location): array
    {
        static $no = 0;
        $no++;
        
        $groupBy = 'provinsi';
        $totalSellers = Seller::where('status', 'approved')->count();
        $percentage = $totalSellers > 0 ? round(($location->total / $totalSellers) * 100, 2) : 0;

        return [
            $no,
            $location->{$groupBy} ?: 'Tidak Disebutkan',
            $location->total,
            $percentage . '%'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
