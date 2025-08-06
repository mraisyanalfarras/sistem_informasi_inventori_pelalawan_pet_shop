<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;

Class BarangExport implements FromQuery, WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'data_barang.xlsx';
    protected $kategori_id, $suplier_id, $search;

    public function __construct($kategori_id = null, $suplier_id = null, $search = null)
    {
        $this->kategori_id = $kategori_id;
        $this->suplier_id = $suplier_id;
        $this->search = $search;
    }

    public function query()
    {
        return Barang::query()
            ->with(['kategori', 'suplier'])
            ->when($this->kategori_id, fn($q) => $q->where('kategori_id', $this->kategori_id))
            ->when($this->suplier_id, fn($q) => $q->where('suplier_id', $this->suplier_id))
            ->when($this->search, fn($q) => $q->where('nama_barang', 'like', '%'.$this->search.'%'));
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Kategori',
            'Suplier',
            'Stok',
            'Harga Beli',
            'Harga Jual',
            'Satuan',
            'Deskripsi',
            'Created At',
        ];
    }
}
