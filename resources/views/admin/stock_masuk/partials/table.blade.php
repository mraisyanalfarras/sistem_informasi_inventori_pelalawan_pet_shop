@if(session('stock_masuk'))
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Suplier</th>
            <th>Tanggal Masuk</th>
        </tr>
    </thead>
    <tbody>
        @foreach (session('stock_masuk') as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ \App\Models\Barang::find($item['barang_id'])->nama_barang ?? '-' }}</td>
            <td>{{ $item['jumlah'] }}</td>
            <td>{{ $item['keterangan'] ?? '-' }}</td>
            <td>{{ \App\Models\Suplier::find($item['suplier_id'])->nama ?? '-' }}</td>
            <td>{{ $item['tanggal_masuk'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-muted">Belum ada barang ditambahkan.</p>
@endif
