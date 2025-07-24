<?php

namespace App\Http\Controllers;

use App\Models\DataSio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan use ini

class DataSioController extends Controller
{
    public function index(Request $request)
    {
        // ⏳ Update otomatis status expired
    DataSio::where('expire_date', '<', now())
        ->where('status', 'active')
        ->update(['status' => 'expired']);
        
        $query = DataSio::query();

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

   $datasios = $query->orderBy($sortBy, $sortDir)->paginate(10)->appends($request->query());
        

        return view('admin.datasios.index', compact('datasios'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.datasios.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nik'         => 'required|string',
            'name'        => 'required|string',
            'no_sio'      => 'required|string|unique:data_sios,no_sio',
            'position'    => 'required|string',
            'type_sio'        => 'required|string',
            'class'       => 'required|string',
            'location'    => 'required|string',
            'expire_date' => 'required|date',
            'status'      => 'required|in:active,expired,pending',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            
        ]);

        $data = $request->all();
        $data['reminder'] = Carbon::parse($request->expire_date)->subMonths(6)->toDateString();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sio_foto', 'public');
        }

        DataSio::create($data);

        return redirect()->route('datasios.index')->with('success', 'Data SIO berhasil ditambahkan.');
    }

    public function show(DataSio $datasio)
    {
        return view('admin.datasios.show', compact('datasio'));
    }

    public function edit(DataSio $datasio)
    {
        $users = User::all();
        return view('admin.datasios.edit', compact('datasio', 'users'));
    }

    public function update(Request $request, DataSio $datasio)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nik'         => 'required|string',
            'name'        => 'required|string',
            'no_sio'      => 'required|string|unique:data_sios,no_sio,' . $datasio->id,
            'position'    => 'required|string',
            'type_sio'        => 'required|string',
            'class'       => 'required|string',
            'location'    => 'required|string',
            'expire_date' => 'required|date',
            'status'      => 'required|in:active,expired,pending',
            'foto'        => 'nullable|image|max:9999',
        ]);

        $data = $request->all();
        $data['reminder'] = Carbon::parse($request->expire_date)->subMonths(6)->toDateString();

        if ($request->hasFile('foto')) {
            if ($datasio->foto) {
                Storage::disk('public')->delete($datasio->foto);
            }
            $data['foto'] = $request->file('foto')->store('sio_foto', 'public');
        }

        $datasio->update($data);

        return redirect()->route('datasios.index')->with('success', 'Data SIO berhasil diperbarui.');
    }

    public function destroy(DataSio $datasio)
    {
        if ($datasio->foto) {
            Storage::disk('public')->delete($datasio->foto);
        }

        $datasio->delete();

        return redirect()->route('datasios.index')->with('success', 'Data SIO berhasil dihapus.');
    }

    // // 📄 Method Print PDF
    // public function print(Request $request)
    // {
    //     $query = DataSio::query();

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
    //             $q->where('name', 'like', "%$search%")
    //               ->orWhere('nik', 'like', "%$search%")
    //               ->orWhere('no_sio', 'like', "%$search%");
    //         });
    //     }

    //     $datasios = $query->orderBy('reminder')->get();

    //     $pdf = Pdf::loadView('admin.datasios.report', compact('datasios'));
    //     return $pdf->download('laporan_data_sio.pdf');
    // }

    // public function exportPdf()
    // {
    //     $datasios = \App\Models\DataSio::all(); // ambil semua data SIO
    //     $pdf = Pdf::loadView('admin.datasios.report_pdf', compact('datasios'))
    //               ->setPaper('A4', 'landscape');

    //     return $pdf->download('laporan-data-sio.pdf'); // Atau ->stream() kalau mau tampil dulu
    // }
}
