<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;

class MasterDataEmployeesController extends Controller
{
  public function index(Request $request)
  {
    $employees = Employees::with('contact')->paginate(5);

    if ($request->has('search')) {
      $searchTerm = $request->input('search');
      $employees = Employees::with('contact')
        ->where('fullname', 'like', "%{$searchTerm}%")
        ->orWhere('email', 'like', "%{$searchTerm}%")
        ->paginate(5);
    }

    return view('content.pages.master-data-settings-employees', compact('employees'));
  }

  public function EmployeeForm($id)
  {
    $employee = $id ? Employees::findOrFail($id) : null;
    $companies = Companies::all();
    return view('content.pages.master-data-settings-employees-forms', compact('employee', 'companies'));
  }

  public function AddEmployeeDatabase(Request $request)
  {
    $request->validate([
      'fullname' => 'required|string|max:255',
      'company_id' => 'required',
      'department' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:employees,email',
      'phone' => 'required|string|max:15',
    ]);
    Employees::create($request->all());
    return redirect()->action([MasterDataEmployeesController::class, 'index'])
      ->with('success', 'Employess Updated successfully');
  }

  public function EditEmployeeDatabase(Request $request, $id)
  {
    $request->validate([
      'fullname' => 'required|string|max:255',
      'company_id' => 'required',
      'department' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:employees,email,' . $id,
      'phone' => 'required|string|max:15',
    ]);

    $employee = Employees::findOrFail($id);
    $employee->update($request->all());
    return redirect()->action([MasterDataEmployeesController::class, 'index'])
      ->with('success', 'Employee updated  successfully');
  }

  public function DeleteEmployeeDatabase($id)
  {
    try {
      $employee = Employees::findOrFail($id);
      $employee->delete();

      return redirect()->action([MasterDataEmployeesController::class, 'index'])
        ->with('success', 'Employee deleted successfully');
    } catch (\Exception $e) {
      return redirect()->action([MasterDataEmployeesController::class, 'index'])
        ->with('error', 'Failed to delete Employee');
    }
  }
}
