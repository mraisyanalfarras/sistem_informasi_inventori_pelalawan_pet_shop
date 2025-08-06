<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
        $query = Customer::query();

    if ($request->filled('jenis_kelamin')) {
        $query->where('jenis_kelamin', $request->jenis_kelamin);
    }

     if ($request->filled('search')) {
        $query->where('nama_customer', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('kode_customer')) {
    $query->where('kode_customer', 'like', '%' . $request->kode_customer . '%');
}
    $perPage = $request->input('per_page', 10);

    $customers = $query->paginate($perPage)->appends($request->all());

    return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'jenis_kelamin' => 'nullable|in:Pria,Perempuan',
            'catatan' => 'nullable|string',
        ]);

        // Membuat kode customer otomatis
        $validated['kode_customer'] = 'CUST-' . strtoupper(Str::random(6));

        Customer::create($validated);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'jenis_kelamin' => 'nullable|in:Pria,Perempuan',
            'catatan' => 'nullable|string',
        ]);

        $customer->update($validated);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customer.index')->with('success', 'Customer berhasil dihapus.');
    }
}