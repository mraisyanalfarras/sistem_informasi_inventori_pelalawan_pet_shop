<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data SIM</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Data SIM</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>No SIM</th>
                <th>Posisi</th>
                <th>Jenis SIM</th>
                <th>Lokasi</th>
                <th>Expired</th>
                <th>Reminder</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasims as $i => $sim)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $sim->nik }}</td>
                <td>{{ $sim->name }}</td>
                <td>{{ $sim->no_sim }}</td>
                <td>{{ $sim->position }}</td>
                <td>{{ $sim->type_sim }}</td>
                <td>{{ $sim->location }}</td>
                <td>{{ \Carbon\Carbon::parse($sim->expire_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($sim->reminder)->format('d-m-Y') }}</td>
                <td>{{ ucfirst($sim->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
