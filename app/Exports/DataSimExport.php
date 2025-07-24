<?php

namespace App\Exports;

use App\Models\DataSim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSimExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataSim::select([
            'nik', 'name', 'no_sim', 'position',
            'type_sim', 'location', 'expire_date', 'reminder', 'status'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'NIK', 'Nama', 'No SIM', 'Posisi',
            'Tipe SIM', 'Lokasi', 'Tanggal Expired', 'Reminder', 'Status', 
            'Dibuat Pada', ' '
        ];
    }
}
