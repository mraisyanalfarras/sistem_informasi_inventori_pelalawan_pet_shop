<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Suplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'suplier'])->latest()->get();
        return view('admin.barang.index', compact('barangs'));
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
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_barang')) {
            $file = $request->file('foto_barang');
            $path = $file->store('foto_barang', 'public');
            $validated['foto_barang'] = $path;
        }

        Barang::create($validated);

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
        'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto_barang')) {
        if ($barang->foto_barang) {
            Storage::disk('public')->delete($barang->foto_barang);
        }
        $data['foto_barang'] = $request->file('foto_barang')->store('foto_barang', 'public');
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