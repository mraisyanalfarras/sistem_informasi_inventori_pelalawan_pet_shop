<?php

namespace App\Http\Controllers;

use App\Models\DataSir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan use ini

class DataSirController extends Controller
{
    public function index(Request $request)
    {
        // Otomatis ubah status menjadi expired jika lewat tanggal
        DataSir::where('expire_date', '<', now())
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $query = DataSir::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('expire_range')) {
            $months = (int) $request->expire_range;
            $targetDate = now()->addMonths($months);
            $query->whereDate('expire_date', '<=', $targetDate);
        }

       // Search by name or NIK
       if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('nik', 'like', '%' . $search . '%');
        });
    }
            // Sorting
    $sortBy = $request->get('sort_by', 'reminder'); // default: reminder
    $sortDir = $request->get('sort_dir', 'asc'); // default: asc

    $datasirs = $query->orderBy($sortBy, $sortDir)->paginate(10)->appends($request->query());

       

        return view('admin.datasirs.index', compact('datasirs'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.datasirs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nik'         => 'required|string',
            'nama'        => 'required|string',
            'no_sir'      => 'required|string|unique:data_sirs,no_sir',
            'location'    => 'required|string',
            'expire_date' => 'required|date',
            'status'      => 'required|in:active,expired,revoked',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['reminder'] = Carbon::parse($request->expire_date)->subMonths(6)->toDateString();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sir_foto', 'public');
        }

        DataSir::create($data);

        return redirect()->route('datasirs.index')->with('success', 'Data SIR berhasil ditambahkan.');
    }

    public function show(DataSir $datasir)
    {
        return view('admin.datasirs.show', compact('datasir'));
    }

    public function edit(DataSir $datasir)
    {
        $users = User::all();
        return view('admin.datasirs.edit', compact('datasir', 'users'));
    }

    public function update(Request $request, DataSir $datasir)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nik'         => 'required|string',
            'nama'        => 'required|string',
            'no_sir'      => 'required|string|unique:data_sirs,no_sir,' . $datasir->id,
            'location'    => 'required|string',
            'expire_date' => 'required|date',
            'status'      => 'required|in:active,expired,revoked',
            'foto'        => 'nullable|image|max:9999',
        ]);

        $data = $request->all();
        $data['reminder'] = Carbon::parse($request->expire_date)->subMonths(6)->toDateString();

        if ($request->hasFile('foto')) {
            if ($datasir->foto) {
                Storage::disk('public')->delete($datasir->foto);
            }
            $data['foto'] = $request->file('foto')->store('sir_foto', 'public');
        }

        $datasir->update($data);

        return redirect()->route('datasirs.index')->with('success', 'Data SIR berhasil diperbarui.');
    }

    public function destroy(DataSir $datasir)
    {
        if ($datasir->foto) {
            Storage::disk('public')->delete($datasir->foto);
        }

        $datasir->delete();

        return redirect()->route('datasirs.index')->with('success', 'Data SIR berhasil dihapus.');
    }

    // // 📄 Method Print PDF
    // public function print(Request $request)
    // {
    //     $query = DataSir::query();

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     if ($request->filled('expire_range')) {
    //         $months = (int) $request->expire_range;
    //         $targetDate = now()->addMonths($months);
    //         $query->whereDate('expire_date', '<=', $targetDate);
    //     }

    //     if ($request->filled('q')) {
    //         $search = $request->q;
    //         $query->where(function ($q) use ($search) {
    //             $q->where('nama', 'like', "%$search%")
    //               ->orWhere('nik', 'like', "%$search%")
    //               ->orWhere('no_sir', 'like', "%$search%");
    //         });
    //     }

    //     $datasirs = $query->orderBy('reminder')->get();

    //     $pdf = Pdf::loadView('admin.datasirs.report', compact('datasirs'));
    //     return $pdf->download('laporan_data_sir.pdf');
    // }

    // public function exportPdf()
    // {
    //     $datasirs = \App\Models\DataSir::all(); // ambil semua data SIR
    //     $pdf = Pdf::loadView('admin.datasirs.report_pdf', compact('datasirs'))
    //               ->setPaper('A4', 'landscape');

    //     return $pdf->download('laporan-data-sir.pdf'); // Atau ->stream() kalau mau tampil dulu
    // }
}
