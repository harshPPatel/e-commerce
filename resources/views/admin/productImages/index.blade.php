@extends('layouts.admin')

{{-- Page Title --}}
@section('title')
 {{ config('app.name') }} | Admin - Product Images
@endsection

@section('pageHeader')
  <!-- page Header -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title">Product Images</h2>
        <p class="pageheader-text">
          List of available Images for the product in the store.
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
                Images
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
      <h5 class="card-header">Add Product Image</h5>
      <div class="card-body">
        <h4>Only Images are allowed. Other files will be ignored!</h4>
        @include('admin.productImages.addForm')
      </div>
    </div>
    <!-- End Form Card -->

  </div>
  <!-- End of Product Color Form -->

  <!-- Categories List Table -->
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
    <div class="card">
      <h5 class="card-header">Product Images</h5>
      <div class="card-body">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product Image</th>
              <th scope="col">Is Featured?</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @if(count($productImages) > 0)
              @foreach ($productImages as $productImage)
                <tr>
                  <td scope="row">{{ $loop->index+1 }}</td>
                  <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productImageModal{{ $loop->index+1 }}">
                      <img src="/storage/productImages/{{ $productImage->product_image }}" alt="{{ $productImage->product->product_name }}" style="max-height: 2rem;">
                    </button> 
                    <!-- Modal --> 
                    <div class="modal fade" id="productImageModal{{ $loop->index+1 }}" tabindex="-1" role="dialog" aria-labelledby="{{ $productImage->product->product_name }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $productImage->product->product_name }}'s Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img src="/storage/productImages/{{ $productImage->product_image }}" alt="{{ $productImage->product->product_name }}" style="max-height: 50vh; width: auto;">
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    {{ $productImage->is_featured == 1 ? 'Yes' : 'No' }}
                  </td>
                  <td>
                    <a 
                      href="/user/admin/products/{{ $product_id }}/images/{{ $productImage->product_image_id }}/edit" 
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
                      data-target="#deleteProductImageModal{{ $loop->index+1 }}">
                        Delete
                    </button>
                    <!-- Delete category modal -->
                    <div class="modal fade" id="deleteProductImageModal{{ $loop->index+1 }}" 
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
                              Do you really want to delete the Product Image?
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            <form 
                              action="/user/admin/products/{{ $product_id }}/images/{{ $productImage->product_image_id }}" 
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
                <td scope="row" colspan="5">No Image Found!</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection