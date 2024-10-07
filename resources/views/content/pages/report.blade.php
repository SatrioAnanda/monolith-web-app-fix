@extends('layouts/contentNavbarLayout')

@section('title', 'Master Data - Companies')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <Box style="display: flex; justify-content: space-between;">
          <h4 class="mb-1">Report Companies</h4>
        </Box>
        <div class="error"></div>
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="text-nowrap">Company Name</th>
              <th class="text-nowrap text-center">Total Employee</th>
            </tr>
          </thead>
          <tbody>
            @if($companies && $companies->count() > 0)
            @foreach ($companies as $company)
            <tr>
              <td class="text-nowrap text-heading">{{ $company->company_name }}</td>
              <td class="text-nowrap text-center">{{ $company->total_employees}}</td>
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