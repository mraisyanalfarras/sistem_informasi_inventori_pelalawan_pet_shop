<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $attendances = Attendance::with(['employee.user'])->get(); // Eager load untuk menghindari N+1 problem
            return view('admin.attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('user')->get(); // Ambil semua karyawan untuk dropdown
        return view('admin.attendance.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'         => 'required|exists:employees,user_id', // Validasi jika user_id ada di tabel employees
            'attendance_date' => 'required|date',
            'status'          => 'required|in:present,absent,on_leave',
        ]);

        Attendance::create($validatedData);
        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::with('user')->get(); // Ambil semua karyawan untuk dropdown
        return view('admin.attendance.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([
            'user_id'         => 'required|exists:employees,user_id',
            'attendance_date' => 'required|date',
            'status'          => 'required|in:present,absent,on_leave',
        ]);

        $attendance->update($validatedData);
        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil dihapus.');
    }
}
