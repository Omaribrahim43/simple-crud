<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDataTable;
use App\Models\Companies;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.admin.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'max:4196', 'image'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:30'],
        ]);

        $company = new Companies();

        $imagePath = $this->uploadImage($request, 'logo', 'logos');
        $company->logo = $imagePath;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->save();

        $notification = array(
            'message' => 'User Created Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.companies.index')->with($notification);
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
        $companies = Companies::findOrFail($id);
        return view('backend.pages.admin.companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['nullable', 'max:4196', 'image'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:30'],
        ]);

        $company = Companies::findOrFail($id);

        $imagePath = $this->updateImage($request, 'logo', 'logos', $company->logo);
        $company->logo = empty(!$imagePath) ? $imagePath : $company->logo;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->save();

        $notification = array(
            'message' => 'Company Updated Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.companies.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Companies::findOrFail($id);
        $this->deleteImage($company->logo);
        $company->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
