@extends('layouts.admin')

{{-- Page Title --}}
@section('title')
 {{ config('app.name') }} | Admin - Product Datasheets
@endsection

@section('pageHeader')
  <!-- page Header -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title">Product Datasheets</h2>
        <p class="pageheader-text">
          List of available Datasheets for the product in the store.
        </p>
        <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#" class="breadcrumb-link">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="/user/admin/products" class="breadcrumb-link">Products</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Datasheets
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Pageheader --> 
@endsection

@section('content')
  <!-- Product Color Form -->
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

    {{-- Success Message --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    {{-- error Message --}}
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <!-- Form Card -->
    <div class="card">
      <h5 class="card-header">Edit Product Datasheet</h5>
      <div class="card-body">
        @include('admin.productDatasheets.editForm')
      </div>
    </div>
    <!-- End Form Card -->

  </div>
  <!-- End of Product Color Form -->

  <!-- Categories List Table -->
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
    <div class="card">
      <h5 class="card-header">Product Datasheets</h5>
      <div class="card-body">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Specification Name</th>
              <th scope="col">Value</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @if(count($productDatasheets) > 0)
              @foreach ($productDatasheets as $productDatasheet)
                <tr>
                  <td scope="row">{{ $loop->index+1 }}</td>
                  <td>{{ $productDatasheet->specification_name }}</td>
                  <td>{{ $productDatasheet->specification_value }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-primary" disabled>Edit</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-sm" disabled>Delete</button>
                  </td>
                </tr>
              @endforeach
            @else
              <tr class="text-center">
                <td scope="row" colspan="5">No Datasheets Found!</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection