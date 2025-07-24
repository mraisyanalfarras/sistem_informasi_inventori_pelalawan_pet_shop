<?php

namespace App\Http\Controllers;

use App\Models\suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supliers = Suplier::latest()->get();
        return view('admin.suplier.index', compact('supliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_suplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Suplier::create($validated);

        return redirect()->route('suplier.index')->with('success', 'Suplier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suplier $suplier)
    {
        return view('admin.suplier.show', compact('suplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suplier $suplier)
    {
        return view('suplier.edit', compact('suplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suplier $suplier)
    {
        $validated = $request->validate([
            'nama_suplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $suplier->update($validated);

        return redirect()->route('suplier.index')->with('success', 'Suplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suplier $suplier)
    {
        $suplier->delete();
        return redirect()->route('suplier.index')->with('success', 'Suplier berhasil dihapus.');
    }
}