<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function dashboard()
    {
        $companies = \App\Models\Company::all();
        return view('dashboard', compact('companies'));
    }
    public function add_companies()
    {

        $statecityFile = storage_path('app/state_city.json');
        $scfile = file_get_contents($statecityFile);
        $states = json_decode($scfile, true);

        $countryFile = storage_path('app/country.json');
        $countryjson = file_get_contents($countryFile);
        $countries = json_decode($countryjson, true);

        $type = 'add';

        return view('company.addEditCompany', compact('states', 'countries', 'type'));
    }

    public function create_companies(Request $request)
    {
        $validated = $request->validate([
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:15',
            'services' => 'required|array',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'branch' => 'required|array',
        ]);
        $fileName = null;

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo'); 
            $fileName = time() . '_' . $file->getClientOriginalName(); 

            $uploadPath = public_path('storage/company_logos');
            if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
            }

            $path = $file->move($uploadPath, $fileName);
            if (!$path) {
            return back()->with('error', 'Failed to upload file.');
            }
        }

        \App\Models\Company::create([
            'company_logo' => $fileName,
            'company_name' => $validated['company_name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'services' => $validated['services'] ?? [],
            'country' => $validated['country'] ?? null,
            'state' => $validated['state'] ?? null,
            'city' => $validated['city'] ?? null,
            'branch' => $validated['branch'] ?? [],
        ]);


        return redirect()->route('dashboard')->with('success', 'Company created successfully!');
    }

    public function edit_companies($id)
    {
        $company = \App\Models\Company::find($id);
        if ($company) {

            $statecityFile = storage_path('app/state_city.json');
            $scfile = file_get_contents($statecityFile);
            $states = json_decode($scfile, true);

            $countryFile = storage_path('app/country.json');
            $countryjson = file_get_contents($countryFile);
            $countries = json_decode($countryjson, true);

            $type = 'edit';

            return view('company.addEditCompany', compact('states', 'countries', 'company', 'type'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Company not found.');
        }
    }

    public function update_companies(Request $request, $id)
    {
        $company = \App\Models\Company::find($id);
        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'Company not found.');
        }

        $validated = $request->validate([
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:15',
            'services' => 'required|array',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'branch' => 'required|array',
        ]);

        if ($request->hasFile('company_logo')) {
            if ($company->company_logo) {
                Storage::delete('public/company_logos/' . $company->company_logo);
            }

            $file = $request->file('company_logo');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $uploadPath = public_path('storage/company_logos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $path = $file->move($uploadPath, $fileName);
            if (!$path) {
                return back()->with('error', 'Failed to upload file.');
            }
            $company->company_logo = $fileName;
        }

        $company->update([
            'company_name' => $validated['company_name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'services' => $validated['services'] ?? [],
            'country' => $validated['country'] ?? null,
            'state' => $validated['state'] ?? null,
            'city' => $validated['city'] ?? null,
            'branch' => $validated['branch'] ?? [],
        ]);

        return redirect()->route('dashboard')->with('success', 'Company updated successfully!');
    }

    public function delete_companies($id)
    {
        $company = \App\Models\Company::find($id);
        if ($company) {
            if ($company->company_logo) {
                Storage::delete('public/company_logos/' . $company->company_logo);
            }
            $company->delete();
            return redirect()->route('dashboard')->with('success', 'Company deleted successfully!');
        } else {
            return redirect()->route('dashboard')->with('error', 'Company not found.');
        }
    }
}
