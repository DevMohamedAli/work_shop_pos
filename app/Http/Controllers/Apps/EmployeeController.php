<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get employees
        $employees = Employee::when(request()->q, function($query) {
            $query->where('name', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        // Return Inertia
        return Inertia::render('Apps/Employees/Index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Apps/Employees/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:employees',
            'address' => 'required',
            'commission_rate' => 'nullable|numeric',

        ]);

        // Create the employee
        Employee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'relatives_phone' => $request->relatives_phone,
            'blood_type' => $request->blood_type,
            'address' => $request->address,
            'commission_rate' => $request->commission_rate,
        ]);

        // Redirect
        return redirect()->route('apps.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return Inertia::render('Apps/Employees/Edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:employees,phone,'.$employee->id,
            'address' => 'required',
            'commission_rate' => 'nullable|numeric',
        ]);

        // Update the employee
        $employee->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'relatives_phone' => $request->relatives_phone,
            'blood_type' => $request->blood_type,
            'address' => $request->address,
            'commission_rate' => $request->commission_rate,
        ]);

        // Redirect
        return redirect()->route('apps.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        // Delete the employee
        $employee->delete();

        // Redirect
        return redirect()->route('apps.employees.index');
    }
}
