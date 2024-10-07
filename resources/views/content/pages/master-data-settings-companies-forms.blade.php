@extends('layouts/contentNavbarLayout')

@section('title', 'Master Data - Companies')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card mb-6">
      <!-- Companies -->
      <div class="card-body pt-4">
        <form id="formAccountSettings" method="POST" action="{{ isset($company) ? route('master-data-settings-companies-edit-save', $company->company_id) : route('master-data-company-save') }}">
          @csrf
          @if(isset($company))
          @method('PUT')
          @endif
          <div class="row g-6">
            <div class="col-md-12">
              <h3>@if(isset($company))
                Edit Company
                @else
                Add Company
                @endif
              </h3>
            </div>
            <div class="col-md-12">
              <label for="company_name" class="form-label">Company Name</label>
              <input class="form-control" type="text" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}" autofocus />
            </div>
            <div class="col-md-12">
              <label for="company_email" class="form-label">Company Email</label>
              <input class="form-control" type="email" name="company_email" value="{{ old('company_email', $company->company_email ?? '') }}" placeholder="john.doe@example.com" />
            </div>
            <div class="col-md-12">
              <label for="company_address" class="form-label">Company Address</label>
              <input class="form-control" type="text" id="company_address" name="company_address" value="{{ old('company_address', $company->company_address ?? '') }}" />
            </div>
            <div class="col-md-12">
              <label for="company_phone" class="form-label">Company Phone</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">IN (+62)</span>
                <input type="text" id="company_phone" name="company_phone" class="form-control" placeholder="0857 9733 5342" value="{{ old('company_phone', $company->company_phone ?? '') }}" />
              </div>
            </div>
          </div>
          <div class="mt-6">
            <button type="submit" class="btn btn-primary me-3">Save changes</button>
            <a href="{{ url('/pages/master-data-settings-companies') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
      <!-- /Companies -->
    </div>
  </div>
</div>
@endsection