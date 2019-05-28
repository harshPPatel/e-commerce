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
          List of available Datasheet for the product in the store.
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
      <h5 class="card-header">Add Product Datasheet</h5>
      <div class="card-body">
        @include('admin.productDatasheets.addForm')
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
                    <a 
                      href="/user/admin/products/{{ $product_id }}/datasheets/{{ $productDatasheet->product_datasheet_id }}/edit" 
                      class="btn btn-sm btn-primary">
                        Edit
                    </a>
                  </td>
                  <td>
                    <!-- Button trigger modal -->
                    <button 
                      type="button" 
                      class="btn btn-danger btn-sm" 
                      data-toggle="modal" 
                      data-target="#deleteProductDatasheetModal{{ $loop->index+1 }}">
                        Delete
                    </button>
                    <!-- Delete category modal -->
                    <div class="modal fade" id="deleteProductDatasheetModal{{ $loop->index+1 }}" 
                      tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-left">
                            <p class="mtb--10 text-danger">
                              Do you really want to delete the Product Datasheet?
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            <form 
                              action="/user/admin/products/{{ $product_id }}/datasheets/{{ $productDatasheet->product_datasheet_id }}" 
                              method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr class="text-center">
                <td scope="row" colspan="5">No Datasheet Found!</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection