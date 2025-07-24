<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        // Fetch departments using query builder and paginate
        $departments = DB::table('departments')->paginate(10); // Adjust the number of items per page
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Insert the new department into the database
        DB::table('departments')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        // Fetch the department by ID
        $departments = DB::table('departments')->where('id', $id)->first();
        
        if (!$departments) {
            return redirect()->route('departments.index')->with('error', 'Department not found.');
        }

        return view('admin.departments.edit', compact('departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update the department
        DB::table('departments')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        // Delete the department by ID
        DB::table('departments')->where('id', $id)->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}