@extends('layouts.admin')

@section('title')
    {{ config('app.name') }} | Admin - Add Product Sizes
@endsection

@section('token')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pageHeader')
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Add Product Sizes</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#" class="breadcrumb-link">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                <a href="/user/admin/products" class="breadcrumb-link">Products</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Product Sizes
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
@endsection


@section('content')
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
    <div class="card">
      <h3 class="card-header">
        <span class="display-7 mr-lg-2">Product Sizes</span>
      </h3>
      <div class="card-body">
        @if( session('success') )
          <div class="alert alert-success alert-dismissible" role="alert">
              {{ session('success') }}
              <button 
                type="button" 
                class="close" 
                data-dismiss="alert" 
                aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
        @if( session('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button 
                  type="button" 
                  class="close" 
                  data-dismiss="alert" 
                  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form 
          action="/user/admin/products/{{ $product_id }}/sizes" 
          method="post" 
          id="basicform" 
          data-parsley-validate="" 
          enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="productSize">Product Size :</label>
              <input 
                id="productSize" 
                type="text" 
                name="product_size" 
                data-parsley-trigger="change" 
                placeholder="Type here..." 
                autocomplete="off" 
                class="form-control">
            </div>
            <div class="row">
              <div class="col-12">
                @if($errors->any())
                  @foreach($errors->all() as $error)
                    <p class="text-danger mt-1" role="alert">
                        <strong>{{ $error }}</strong>
                    </p>
                  @endforeach
                @endif
                <p class="text-right mb-3 mt-3">
                  <button type="submit" class="btn btn-primary btn-space">Add</button>
                  <button type="reset" class="btn btn-space btn-light">Reset</button>
                </p>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
    <div class="card">
      <h3 class="card-header">
        <span class="display-7 mr-lg-2">Sizes</span>
      </h3>
      <div class="card-body" id="sizes">
        <table class="table table-hover table-borded text-center">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Size</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody id="sizeTable">
            @if(count($sizes) > 0)
              @foreach($sizes as $size)
                <tr>
                  <td scope="col">{{ $loop->index+1 }}</td>
                  <td scope="col">{{ $size->product_size }}</td>
                  <td scope="col">
                    <a 
                      href="/user/admin/products/{{ $product_id }}/sizes/{{ $size->product_size_id }}/edit" 
                      class="btn btn-sm btn-primary">
                        Edit
                    </a>
                  </td>
                  <td scope="col">
                    <!-- Button trigger modal -->
                    <button 
                      type="button" 
                      class="btn btn-danger btn-sm" 
                      data-toggle="modal" 
                      data-target="#deleteProductSizeModal{{ $loop->index+1 }}">
                        Delete
                    </button>
                    <!-- Delete category modal -->
                    <div 
                      class="modal fade" 
                      id="deleteProductSizeModal{{ $loop->index+1 }}" 
                      tabindex="-1" 
                      role="dialog" 
                      aria-labelledby="exampleModalLabel" 
                      aria-hidden="true">
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
                                      Do you really want to delete the Product size?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                    <form 
                                      action="/user/admin/products/{{ $product_id }}/sizes/{{ $size->product_size_id }}" 
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
              <tr>
                <th colspan="4">No Sizes Found!</th>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection