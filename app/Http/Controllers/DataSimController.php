<?php

namespace App\Http\Controllers;

use App\Models\DataSim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // tambahkan use ini di atas

class DataSimController extends Controller
{
    public function index(Request $request)
    {
        $query = DataSim::query();

         DataSim::where('expire_date', '<', now())
        ->where('status', 'active')
        ->update(['status' => 'expired']);

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

         // Filter by expire date range
    if ($request->filled('expire_start') && $request->filled('expire_end')) {
        $query->whereBetween('expire_date', [$request->expire_start, $request->expire_end]);
    } elseif ($request->filled('expire_start')) {
        $query->where('expire_date', '>=', $request->expire_start);
    } elseif ($request->filled('expire_end')) {
        $query->where('expire_date', '<=', $request->expire_end);
    }

           // Sorting
    $sortBy = $request->get('sort_by', 'reminder'); // default: reminder
    $sortDir = $request->get('sort_dir', 'asc'); // default: asc

    $datasims = $query->orderBy($sortBy, $sortDir)->paginate(10)->appends($request->query());

    return view('admin.datasims.index', compact('datasims'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.datasims.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nik'         => 'required|string',
            'name'        => 'required|string',
            'no_sim'      => 'required|string|unique:data_sims,no_sim',
            'position'    => 'required|string',
            'type_sim'    => 'required|string',
            'location'    => 'required|string',
            'expire_date' => 'required|date',
            'status'      => 'required|in:active,expired,revoked',
            'foto'        => 'nullable|image|max:9999',
        ]);

        $data = $request->all();
        $data['reminder'] = Carbon::parse($request->expire_date)->subMonths(6)->toDateString();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sim_foto', 'public');
        }

        DataSim::create($data);

        return redirect()->route('datasims.index')->with('success', 'Data SIM berhasil ditambahkan.');
    }

    public function show(DataSim $datasim)
    {
        return view('admin.datasims.show', compact('datasim'));
    }

    public function edit(DataSim $datasim)
    {
        $users = User::all();
        return view('admin.datasims.edit', compact('datasim', 'users'));
    }

    public function update(Request $request, DataSim $datasim)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nik'         => 'required|string',
            'name'        => 'required|string',
            'no_sim'      => 'required|string|unique:data_sims,no_sim,' . $datasim->id,
            'position'    => 'required|string',
            'type_sim'    => 'required|string',
            'location'    => 'required|string',
            'expire_date' => 'required|date',
            'status'      => 'required|in:active,expired,revoked',
            'foto'        => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['reminder'] = Carbon::parse($request->expire_date)->subMonths(6)->toDateString();

        if ($request->hasFile('foto')) {
            if ($datasim->foto) {
                Storage::disk('public')->delete($datasim->foto);
            }
            $data['foto'] = $request->file('foto')->store('sim_foto', 'public');
        }

        $datasim->update($data);

        return redirect()->route('datasims.index')->with('success', 'Data SIM berhasil diperbarui.');
    }

    public function destroy(DataSim $datasim)
    {
        if ($datasim->foto) {
            Storage::disk('public')->delete($datasim->foto);
        }

        $datasim->delete();

        return redirect()->route('datasims.index')->with('success', 'Data SIM berhasil dihapus.');
    }


    // 📄 Method Print PDF
    public function print(Request $request)
    {
        $query = DataSim::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('expire_range')) {
            $months = (int) $request->expire_range;
            $targetDate = now()->addMonths($months);
            $query->whereDate('expire_date', '<=', $targetDate);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
            });
        }

        $datasims = $query->orderBy('reminder')->get();

        $pdf = Pdf::loadView('admin.datasims.report', compact('datasims'));
        return $pdf->download('laporan_data_sim.pdf');
    }

    public function exportPdf()
{
    $datasims = \App\Models\DataSim::all(); // ambil semua data SIM
    $pdf = Pdf::loadView('admin.datasims.report_pdf', compact('datasims'))
              ->setPaper('A4', 'landscape');

    return $pdf->download('laporan-data-sim.pdf'); // Atau ->stream() kalau mau tampil dulu
}

    
}
