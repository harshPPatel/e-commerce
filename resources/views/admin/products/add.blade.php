@extends('layouts.admin')

@section('title')
    {{ config('app.name') }} | Admin - Add Product
@endsection

@section('pageHeader')
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Add Product</h2>
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
                                Add Product
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
    <div class="col-12">
      <div class="card">
        <h3 class="card-header">
          <span class="display-7 mr-lg-2">Product Details</span>
        </h3>
        <div class="card-body">
          @if( session('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          @if( session('error') )
              <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif

          <form action="/user/admin/products" method="post" id="basicform" data-parsley-validate="" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="productName">Product name :</label>
              <input id="productName" type="text" name="product_name" data-parsley-trigger="change" required placeholder="Type here..." autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
              <label for="sub_category_id">Product Sub Category</label>
              <select name="sub_category_id" id="sub_category_id" class="form-control">
                @foreach ($categories as $category)
                  @php
                    // Sub categories for each category
                    $subCats = [];
                    foreach ($subCategories as $subCategory) {
                      if ($category->category_id == $subCategory->category_id) {
                        array_push($subCats, $subCategory);
                      }
                    }
                  @endphp
                  <optgroup label="{{$category->category_name}}">
                    @foreach($subCats as $subCategory)
                      <option value="{{ $subCategory->sub_category_id }}">{{ $subCategory->sub_category_name }}</option>
                    @endforeach
                  </optgroup>                    
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="productPrice">Product Price :</label>
              <input id="productPrice" type="text" name="product_price" data-parsley-trigger="change" required placeholder="Type here..." autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
              <label for="productDescription">Product Description :</label>
              <textarea id="productDescription" name="product_description" data-parsley-trigger="change" required placeholder="Type here..." autocomplete="off" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="productStock">Product Stock :</label>
              <input id="productStock" type="text" name="product_stock" data-parsley-trigger="change" required placeholder="Type here..." autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="productIsFeature">Is Featured?</label>
                  <select id="productIsFeature" name="is_featured" autocomplete="off" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="productIsAvailable">Product Status</label>
                  <select id="productIsAvailable" name="is_available" autocomplete="off" class="form-control">
                    <option value="1" selected>Available</option>
                    <option value="0">Hidden</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="productVideo">Product Video</label>
                  <input type="file" class="form-control-file" id="productVideo" name="product_video">
                  <p class="pt-2 pb-2">File should be less than 10 MB.</p>
                </div>
              </div>
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
                <p class="text-right">
                  <button type="reset" class="btn btn-space btn-light">Reset</button>
                  <button type="submit" class="btn btn-space btn-primary">Add Product</button>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection