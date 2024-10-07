<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\MasterDataCompaniesController;
use App\Http\Controllers\pages\MasterDataEmployeesController;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\ReportController;

// Main Page Route
Route::get('/', [ReportController::class, 'index'])->name('dashboard-analytics');

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// Master Data
Route::get('/pages/master-data-settings-companies', [MasterDataCompaniesController::class, 'index'])->name('master-data-settings-companies');
Route::get('/pages/master-data-settings-companies/form/{id}', [MasterDataCompaniesController::class, 'CompanyForm'])->name('master-data-settings-companies-form');
Route::put('/pages/master-data-settings-companies/form/{id}', [MasterDataCompaniesController::class, 'EditCompanyDatabase'])->name('master-data-settings-companies-edit-save');
Route::post('/pages/master-data-settings-companies/form', [MasterDataCompaniesController::class, 'AddCompanyDatabase'])->name('master-data-company-save');
Route::delete('/pages/master-data-settings-companies/{id}', [MasterDataCompaniesController::class, 'DeleteCompanyDatabase'])->name('master-data-company-delete');
Route::get('/pages/master-data-settings-employees', [MasterDataEmployeesController::class, 'index'])->name('master-data-settings-employees');
Route::get('/pages/master-data-settings-employees/form/{id}', [MasterDataEmployeesController::class, 'EmployeeForm'])->name('master-data-settings-employees-form');
Route::put('/pages/master-data-settings-employees/form/{id}', [MasterDataEmployeesController::class, 'EditEmployeeDatabase'])->name('master-data-settings-employees-edit-save');
Route::post('/pages/master-data-settings-employees/form', [MasterDataEmployeesController::class, 'AddEmployeeDatabase'])->name('master-data-employees-save');
Route::delete('/pages/master-data-settings-employees/{id}', [MasterDataEmployeesController::class, 'DeleteEmployeeDatabase'])->name('master-data-employees-delete');

//Report
Route::get('/pages/report', [ReportController::class, 'index'])->name('reporting');

// Not Found 
Route::fallback([MiscError::class, 'index']);
