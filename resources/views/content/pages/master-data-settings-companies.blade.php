@extends('layouts/contentNavbarLayout')

@section('title', 'Master Data - Companies')

@section('content')
<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-body">
        <Box style="display: flex; justify-content: space-between;">
          <h4 class="mb-1">Companies</h4>
          <a href="{{url('/pages/master-data-settings-companies/form/0')}}" class="btn btn-primary me-3">Add Companies</a>
        </Box>
        <div class="error"></div>
      </div>

      @if(session('success'))
      <div class="alert alert-success mt-3" id="success-alert">
        {{ session('success') }}
      </div>
      @endif
      @if(session('error'))
      <div class="alert alert-danger mt-3" id="error-alert">
        {{ session('error') }}
      </div>
      @endif

      <div class="row mb-3">
        <div class="col-md-12 text-end">
          <form method="GET" action="{{ url('/pages/master-data-settings-companies') }}" class="d-inline-block">
            <div class="input-group">
              <input type="text" class="form-control" name="search" placeholder="Search companies..." value="{{ request('search') }}" style="margin-right: 5px;">
              <button class="btn btn-primary" type="submit" style="margin-right: 10px;"> <i class='bx bx-search-alt-2'></i> Search</button>
            </div>
          </form>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="text-nowrap">Name</th>
              <th class="text-nowrap text-center">Email</th>
              <th class="text-nowrap text-center">Browser</th>
              <th class="text-nowrap text-center">Phone</th>
              <th class="text-nowrap text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($companies && $companies->count() > 0)
            @foreach ($companies as $company)
            <tr>
              <td class="text-nowrap text-heading">{{ $company->company_name }}</td>
              <td class="text-nowrap text-center">{{ $company->company_address }}</td>
              <td class="text-nowrap text-center">{{ $company->company_email }}</td>
              <td class="text-nowrap text-center">{{ $company->company_phone }}</td>
              <td class="text-nowrap text-center">
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="action{{ $company->company_id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="action{{ $company->company_id }}">
                    <a href="{{route('master-data-settings-companies-form', $company->company_id)}}" class="dropdown-item">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <form action="{{ route('master-data-company-delete', $company->company_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="5">
                <div style="display: flex; justify-content:center;">
                  Data Tidak Ditemukan
                </div>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
        <!-- Menambahkan pagination -->
        <Box style="display:flex ; justify-content:end; margin-top:15px; margin-right:10px">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              {{-- Previous Page Link --}}
              @if ($companies->onFirstPage())
              <li class="page-item disabled first">
                <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevrons-left bx-sm"></i></a>
              </li>
              <li class="page-item disabled prev">
                <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevron-left bx-sm"></i></a>
              </li>
              @else
              <li class="page-item first">
                <a class="page-link" href="{{ $companies->url(1) }}"><i class="bx bx-chevrons-left bx-sm"></i></a>
              </li>
              <li class="page-item prev">
                <a class="page-link" href="{{ $companies->previousPageUrl() }}"><i class="bx bx-chevron-left bx-sm"></i></a>
              </li>
              @endif

              {{-- Pagination Elements --}}
              @for ($i = 1; $i <= $companies->lastPage(); $i++)
                <li class="page-item {{ $i == $companies->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $companies->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($companies->hasMorePages())
                <li class="page-item next">
                  <a class="page-link" href="{{ $companies->nextPageUrl() }}"><i class="bx bx-chevron-right bx-sm"></i></a>
                </li>
                <li class="page-item last">
                  <a class="page-link" href="{{ $companies->url($companies->lastPage()) }}"><i class="bx bx-chevrons-right bx-sm"></i></a>
                </li>
                @else
                <li class="page-item disabled next">
                  <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevron-right bx-sm"></i></a>
                </li>
                <li class="page-item disabled last">
                  <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevrons-right bx-sm"></i></a>
                </li>
                @endif
            </ul>
          </nav>
        </Box>
      </div>
    </div>
  </div>
</div>


<style>
  .fade {
    opacity: 0;
    transition: opacity 0.5s ease;
  }
</style>

<script>
  window.onload = function() {
    setTimeout(function() {
      var successAlert = document.getElementById('success-alert');
      var errorAlert = document.getElementById('error-alert');

      if (successAlert) {
        successAlert.classList.remove('show');
        successAlert.classList.add('fade');
        setTimeout(function() {
          successAlert.remove();
        }, 500);
      }

      if (errorAlert) {
        errorAlert.classList.remove('show');
        errorAlert.classList.add('fade');
        setTimeout(function() {
          errorAlert.remove();
        }, 500);
      }
    }, 3000);
  }
</script>
@endsection