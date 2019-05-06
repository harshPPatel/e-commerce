@extends('layouts.admin')

@section('title')
    {{ config('app.name') }} | Admin - Add Product
@endsection

@section('token')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pageHeader')
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Add Product</h2>
                <p class="pageheader-text">Step 2</p>
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
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
      <div class="card">
        <h3 class="card-header">
          <span class="display-7 mr-lg-2">Product Sizes</span> (Step - 2)
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

          <form action="/user/admin/products/add/sizes" method="post" id="basicform" data-parsley-validate="" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="productSize">Product Size :</label>
              <input id="productSize" type="text" name="product_size" data-parsley-trigger="change" placeholder="Type here..." autocomplete="off" class="form-control">
            </div>
            <div class="row">
              <div class="col-12">
                <p class="text-danger mt-1" id="formError" role="alert">
                </p>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="text-danger mt-1" role="alert">
                            <strong>{{ $error }}</strong>
                        </p>
                    @endforeach
                @endif
                <div class="text-right mb-3 mt-3">
                  <button type="button" id="addButton" class="btn btn-primary btn-space">Add</button>
                  <button type="reset" class="btn btn-space btn-light">Reset</button>
                  <hr>
                </div>
                <p class="text-right">
                  <a href="/user/admin/products/add/cancel" class="btn btn-space btn-secondary">Cancel</a>
                  <button type="button" id="nextStepButton" class="btn btn-space btn-primary">Next Step</button>
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
          <table class="table table-hover table-borded">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Size</th>
              </tr>
            </thead>
            <tbody id="sizeTable">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/addProductSize.js') }}"></script>
  <script>
    
    document.getElementById('nextStepButton').addEventListener('click', function() {
      //Select token with getAttribute
      var TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Sizes from LocalStorage
      var sizes = localStorage.getItem('productSizes');

      // URL to post
      var URL = '/user/admin/products/add/sizes';

      // Redirct URL
      var REDIRECT_URL = '/user/admin/products/add/colors';

      // Fetching URL
      fetch(URL, {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": TOKEN 
        },
        method: 'post',
        // credentials: "same-origin",
        body: JSON.stringify({
          _token: TOKEN,
          productSizes: JSON.parse(sizes), 
        }),
      })
      .then(function(res) {
        return res.json();
        // window.location.href = REDIRECT_URL;
      })
      .catch(function(error) {
        console.log(error);
        
        var addProductSizeError = document.getElementById('formError');
        addProductSizeError.innerHTML = "Error in adding the size! Please try it again!"
      });
    });

  </script>    
@endsection