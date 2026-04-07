<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:departments,code',
            'head_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Department::create($validated);

        return redirect()->route('admin.departments.index')->with('status', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:departments,code,' . $department->id,
            'head_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $department->update($validated);

        return redirect()->route('admin.departments.index')->with('status', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        if ($department->fileTracks()->exists() || $department->fileMovements()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete department with associated file records.');
        }
        $department->delete();
        return redirect()->route('admin.departments.index')->with('status', 'Department deleted successfully.');
    }
}
