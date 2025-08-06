<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Suplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{
   public function index(Request $request)
{
    $kategoriOptions = Kategori::pluck('nama_kategori', 'id');
    $suplierOptions = Suplier::pluck('nama_suplier', 'id');
    $stokLimit = 10;
    $barangHampirHabis = Barang::where('stok', '<', $stokLimit)->get();
    
    $query = Barang::query();
   

    if ($request->has('search')) {
        $query->where('nama_barang', 'like', '%' . $request->search . '%');
    }

    if ($request->kategori_id) {
        $query->where('kategori_id', $request->kategori_id);
    }

    if ($request->suplier_id) {
        $query->where('suplier_id', $request->suplier_id);
    }

    
    $barangs = $query->with(['kategori', 'suplier'])
        ->paginate($request->per_page ?? 10);

    $kategoris = Kategori::all();
    $supliers = Suplier::all();

    return view('admin.barang.index', compact(
    'barangs',
    'kategoris',
    'supliers',
    'kategoriOptions',
    'suplierOptions',
    'barangHampirHabis'
));

}
    public function create()
    {
        $kategoris = Kategori::all();
        $supliers = Suplier::all();
        return view('admin.barang.create', compact('kategoris', 'supliers'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'suplier_id' => 'required|exists:supliers,id',
        'stok' => 'required|integer|min:0',
        'harga_beli' => 'required|integer|min:0',
        'harga_jual' => 'required|integer|min:0',
        'satuan' => 'required|string|max:50',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
    ]);

   $data = $validated;

    // Upload foto barang
    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('barang_foto', 'public');
    }

    Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        $supliers = Suplier::all();
        return view('admin.barang.edit', compact('barang', 'kategoris', 'supliers'));
    }

    public function update(Request $request, Barang $barang)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'suplier_id'  => 'required|exists:supliers,id',
        'stok'        => 'required|integer|min:0',
        'harga_beli'  => 'required|integer|min:0',
        'harga_jual'  => 'required|integer|min:0',
        'satuan'      => 'required|string|max:50',
        'deskripsi'   => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        if ($barang->foto_barang) {
            Storage::disk('public')->delete($barang->foto_barang);
        }
        $data['foto'] = $request->file('foto_barang')->store('foto_barang', 'public');
    }

    $barang->update($data);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
}


    public function destroy(Barang $barang)
{
    if ($barang->foto_barang) {
        Storage::disk('public')->delete($barang->foto_barang);
    }

    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
}

}