<?php

namespace App\Exports;

use App\Models\DataSir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DataSirExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataSir::select(
            'id',
            'nik',
            'nama',
            'position',
            'no_sir',
            'expire_date',
            'status',
            'reminder',
            'location',

        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'Nama',
            'Posisi',
            'Nomor SIR',
            'Tanggal Expired',
            'Status',
            'Reminder',
            'Lokasi',
        
        ];
    }
}