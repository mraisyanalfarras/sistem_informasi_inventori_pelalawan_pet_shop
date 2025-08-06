<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Stock_Masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class StockMasukController extends Controller
{
    public function index()
    {
        $stockMasuks = Stock_Masuk::with(['barang', 'suplier'])->paginate(10);
        return view('admin.stock_masuk.index', compact('stockMasuks'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $supliers = Suplier::all();
        return view('admin.stock_masuk.create', compact('barangs', 'supliers'));
    }

     public function store(Request $request)
{
    $request->validate([
        'suplier_id' => 'required|exists:supliers,id',
        'barang_id.*' => 'required|exists:barangs,id',
        'jumlah.*' => 'required|integer|min:1',
        'keterangan.*' => 'nullable|string',
    ]);

    foreach ($request->barang_id as $index => $barangId) {
        Stock_Masuk::create([
            'barang_id' => $barangId,
            'suplier_id' => $request->suplier_id,
            'jumlah' => $request->jumlah[$index],
            'keterangan' => $request->keterangan[$index] ?? null,
            'tanggal_masuk' => now(),
        ]);

        $barang = Barang::find($barangId);
        $barang->stok += $request->jumlah[$index];
        $barang->save();
    }

    return redirect()->route('stock_masuk.index')->with('success', 'Stok masuk berhasil ditambahkan.');
}

    public function storeDetail(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'suplier_id' => 'required|exists:supliers,id',
        ]);

        $stockMasuk = Stock_Masuk::create($validated);

        // Tambah stok ke barang
        $barang = Barang::find($validated['barang_id']);
        $barang->stok += $validated['jumlah'];
        $barang->save();

        return response()->json([
            'success' => true,
            'data' => $stockMasuk,
            'barang_nama' => $barang->nama_barang,
        ]);
    }

    public function getSessionData()
{
    $data = Session::get('stock_masuk_items', []);
    return response()->json($data);
}

public function addToSession(Request $request)
{
    $data = $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
        'keterangan' => 'nullable|string',
        'suplier_id' => 'required|exists:supliers,id',
        'tanggal_masuk' => 'required|date',
    ]);

    $items = session()->get('stock_masuk', []);
    $items[] = $data;
    session()->put('stock_masuk', $items);

    $html = view('admin.stock_masuk.partials.table')->render();

    return response()->json([
        'success' => true,
        'html' => $html,
    ]);
}

public function clearSession()
{
    Session::forget('stock_masuk_items');
    return response()->json(['success' => true]);
}



    public function destroy($id)
    {
        $masuk = Stock_Masuk::findOrFail($id);

        // Kembalikan stok barang
        $barang = Barang::find($masuk->barang_id);
        if ($barang) {
            $barang->stok -= $masuk->jumlah;
            if ($barang->stok < 0) {
                $barang->stok = 0;
            }
            $barang->save();
        }

        $masuk->delete();
        return redirect()->route('stock_masuk.index')->with('success', 'Data stok masuk berhasil dihapus.');
    }

    public function cetakFilter(Request $request)
{
    $request->validate([
        'tanggal_awal' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    ]);

    $stockMasuks = Stock_Masuk::with(['barang.kategori', 'barang.suplier', 'suplier'])
        ->whereBetween('tanggal_masuk', [$request->tanggal_awal, $request->tanggal_akhir])
        ->orderBy('tanggal_masuk', 'asc')
        ->get();

    $pdf = PDF::loadView('admin.stock_masuk.pdf_filter', [
        'stockMasuks' => $stockMasuks,
        'tanggal_awal' => $request->tanggal_awal,
        'tanggal_akhir' => $request->tanggal_akhir
    ])->setPaper('a4', 'landscape');

    return $pdf->stream('laporan-stok-masuk.pdf');
}
}
