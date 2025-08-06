<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Stock_Keluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StockKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock_Keluar::with(['barang.kategori', 'barang.suplier']);

    if ($request->filled(['tanggal_awal', 'tanggal_akhir'])) {
        $query->whereBetween('tanggal_keluar', [$request->tanggal_awal, $request->tanggal_akhir]);
    }

    $stock_keluars = $query->latest()->get();

        return view('admin.stock_keluar.index', compact('stock_keluars'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('admin.stock_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->withErrors(['jumlah' => 'Stok tidak mencukupi.']);
        }

        Stock_Keluar::create($validated);

        // Kurangi stok
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()->route('stock_keluar.index')->with('success', 'Stok keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $stock_keluars = Stock_Keluar::with(['barang.kategori', 'barang.suplier'])->findOrFail($id);
        return view('admin.stock_keluar.show', compact('stock_keluars'));
    }

    public function destroy(Stock_Keluar $stock_keluar)
    {
        // Tambahkan kembali stok
        $barang = Barang::find($stock_keluar->barang_id);
        $barang->stok += $stock_keluar->jumlah;
        $barang->save();

        $stock_keluar->delete();

        return redirect()->route('stock_keluar.index')->with('success', 'Data stok keluar berhasil dihapus.');
    }

    public function cetakPDF($id)
{
    $stock_keluars = Stock_Keluar::with(['barang.kategori', 'barang.suplier'])->findOrFail($id);
    
    $pdf = Pdf::loadView('admin.stock_keluar.pdf', compact('stock_keluars'))
              ->setPaper('a4', 'portrait');

    return $pdf->stream('detail-stok-keluar.pdf');
}

public function cetakFilter(Request $request)
{
    $request->validate([
        'tanggal_awal' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    ]);

    $stock_keluars = Stock_Keluar::with(['barang.kategori', 'barang.suplier'])
        ->whereBetween('tanggal_keluar', [$request->tanggal_awal, $request->tanggal_akhir])
        ->get();

    $pdf = PDF::loadView('admin.stock_keluar.pdf_filter', compact('stock_keluars'))
               ->setPaper('a4', 'landscape');

    return $pdf->stream("stok_keluar_{$request->tanggal_awal}_sampai_{$request->tanggal_akhir}.pdf");
}


}
