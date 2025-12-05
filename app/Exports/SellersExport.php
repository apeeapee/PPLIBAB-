<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;

class SellersExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Seller::with('user');

        // Filter by search
        if ($this->request->has('search') && $this->request->search != '') {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_toko', 'like', "%{$search}%")
                  ->orWhere('nama_pic', 'like', "%{$search}%")
                  ->orWhere('email_pic', 'like', "%{$search}%")
                  ->orWhere('no_hp_pic', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($this->request->has('status') && $this->request->status != '') {
            $query->where('status', $this->request->status);
        }

        // Filter by date range
        if ($this->request->has('date_from') && $this->request->date_from != '') {
            $query->whereDate('created_at', '>=', $this->request->date_from);
        }
        if ($this->request->has('date_to') && $this->request->date_to != '') {
            $query->whereDate('created_at', '<=', $this->request->date_to);
        }

        // Sorting
        $sort = $this->request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nama_toko', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_toko', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Toko',
            'PIC',
            'Email',
            'No HP',
            'Kecamatan',
            'Kota',
            'Status',
            'Tanggal Daftar'
        ];
    }

    public function map($seller): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $seller->nama_toko,
            $seller->nama_pic,
            $seller->email_pic,
            $seller->no_hp_pic,
            $seller->kecamatan,
            $seller->kota,
            ucfirst($seller->status),
            $seller->created_at->format('d M Y')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
