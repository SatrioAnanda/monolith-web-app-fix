@extends('layouts/contentNavbarLayout')

@section('title', 'Master Data - Employee')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card mb-6">
      <!-- Companies -->
      <div class="card-body pt-4">
        <form id="formAccountSettings" method="POST" action="{{ isset($employee) ? route('master-data-settings-employees-edit-save', $employee->id) : route('master-data-employees-save') }}">
          @csrf
          @if(isset($employee))
          @method('PUT')
          @endif
          <div class="row g-6">
            <div class="col-md-12">
              <h3>@if(isset($employee))
                Edit Employee
                @else
                Add Employee
                @endif
              </h3>
            </div>
            <div class="col-md-12">
              <label for="fullname" class="form-label">Employee Name</label>
              <input class="form-control" type="text" id="fullname" name="fullname" value="{{ old('fullname', $employee->fullname ?? '') }}" autofocus />
            </div>
            <div class="col-md-12" bis_skin_checked="1">
              <label for="defaultSelect" class="form-label">Company</label>
              <select id="company_id" class="form-select" name="company_id">
                <option value="" disabled selected>Select Company</option>
                @foreach($companies as $company)
                <option value="{{ $company->company_id }}" {{ (isset($employee) && $employee->company_id == $company->company_id) ? 'selected' : '' }}>
                  {{ $company->company_name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12">
              <label for="department" class="form-label">Department</label>
              <input class="form-control" type="text" id="department" name="department" value="{{ old('department', $employee->department ?? '') }}" />
            </div>
            <div class="col-md-12">
              <label for="email" class="form-label">Email</label>
              <input class="form-control" type="text" name="email" value="{{ old('email', $employee->email ?? '') }}" placeholder="john.doe@example.com" />
            </div>
            <div class="col-md-12">
              <label for="phone" class="form-label">Phone</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">IN (+62)</span>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="0857 9733 5342" value="{{ old('phone', $employee->phone ?? '') }}" />
              </div>
            </div>
            <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3">Save changes</button>
              <a href="{{url('/pages/master-data-settings-employees')}}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
      </div>
      <!-- /Companies -->
    </div>
  </div>
</div>
@endsection