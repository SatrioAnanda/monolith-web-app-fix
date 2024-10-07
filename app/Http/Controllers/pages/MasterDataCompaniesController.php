<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;

class MasterDataCompaniesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $companies = Companies::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('company_name', 'like', "%{$query}%")
                ->orWhere('company_email', 'like', "%{$query}%")
                ->orWhere('company_address', 'like', "%{$query}%")
                ->orWhere('company_phone', 'like', "%{$query}%");
        })->paginate(5);

        return view('content.pages.master-data-settings-companies', compact('companies', 'query'));
    }

    public function CompanyForm($id)
    {
        $company =  $id ? Companies::findOrFail($id) : null;
        return view('content.pages.master-data-settings-companies-forms', ['company' => $company]);
    }

    public function AddCompanyDatabase(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,company_email',
            'company_address' => 'required|string',
            'company_phone' => 'required|string',
        ]);

        Companies::create([
            'company_name' => $validated['company_name'],
            'company_email' => $validated['company_email'],
            'company_address' => $validated['company_address'],
            'company_phone' => $validated['company_phone'],
        ]);

        return redirect()->action([MasterDataCompaniesController::class, 'index'])
            ->with('success', 'Company Added successfully');
    }

    public function EditCompanyDatabase(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_phone' => 'required|string|max:20',
        ]);

        $company = Companies::findOrFail($id);
        $company->update($validated);

        return redirect()->action([MasterDataCompaniesController::class, 'index'])
            ->with('success', 'Company Updated successfully');
    }

    public function DeleteCompanyDatabase($id)
    {
        try {
            $company = Companies::findOrFail($id);
            $company->delete();

            return redirect()->action([MasterDataCompaniesController::class, 'index'])
                ->with('success', 'Company deleted successfully');
        } catch (\Exception $e) {
            return redirect()->action([MasterDataCompaniesController::class, 'index'])
                ->with('error', 'Failed to delete company');
        }
    }
}
