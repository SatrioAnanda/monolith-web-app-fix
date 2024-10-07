<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $companies = Companies::leftJoin('employees', 'companies.company_id', '=', 'employees.company_id')
            ->select('companies.company_name', \DB::raw('COUNT(employees.id) as total_employees'))
            ->groupBy('companies.company_id', 'companies.company_name')
            ->orderBy('total_employees', 'DESC')
            ->paginate(5); // Change the number to set how many records per page

        return view('content.pages.report', compact('companies'));
    }
}
