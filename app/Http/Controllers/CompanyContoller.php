<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Notifications\NewCompanyNotification;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CompanyContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:companies,email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
        ]);

        // Store the logo file in the storage
        $logoPath = $request->file('logo')->store('public/logos');
        $logoUrl = Storage::url($logoPath);

        // Create a new company record
        $company = new Company();
        $company->name = $validatedData['name'];
        $company->email = $validatedData['email'];
        $company->logo = $logoUrl;
        $company->website = $validatedData['website'];
        $company->save();

        if ($company->id) {
            //notify the admin
            $adminUser = User::where('email', 'sabitri.shrestha03@gmail.com')->first();

            Notification::send($adminUser, new NewCompanyNotification($company));

            session()->flash('success', 'Company created successfully.');

            // Redirect back to the index page or any other page
            return redirect()->route('companies.index');
        } else {
            // Failed to create company
            // Handle the failure or show an error message
            session()->flash('error', 'Error creating the company.');
        }



        // Redirect to the company index page or show success message
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'email' => 'nullable|email|unique:companies,email,' . $company->id,
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }
}
