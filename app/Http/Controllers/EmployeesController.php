<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.admin.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Companies::all();
        return view('backend.pages.admin.employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'max:50'],
            'lname' => ['required', 'max:30'],
            'company_id' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $employee = new Employees();

        $employee->first_name = $request->fname;
        $employee->last_name = $request->lname;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->save();

        $notification = array(
            'message' => 'Employee Created Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.employees.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employees::findOrFail($id);
        $companies = Companies::all();
        return view('backend.pages.admin.employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fname' => ['required', 'max:50'],
            'lname' => ['required', 'max:30'],
            'company_id' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $employee = Employees::findOrFail($id);

        $employee->first_name = $request->fname;
        $employee->last_name = $request->lname;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->save();

        $notification = array(
            'message' => 'Employee Updated Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.employees.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
