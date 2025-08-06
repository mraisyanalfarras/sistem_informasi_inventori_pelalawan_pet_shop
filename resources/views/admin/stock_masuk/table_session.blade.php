@if(session('stock_masuk'))
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach(session('stock_masuk') as $index => $item)
            <tr>
                <td>{{ $item['nama_barang'] }}</td>
                <td>{{ $item['jumlah'] }}</td>
                <td>{{ $item['keterangan'] ?? '-' }}</td>
                <td>
                    <form action="{{ route('stock_masuk.session.remove', $index) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Belum ada barang ditambahkan.</p>
@endif
