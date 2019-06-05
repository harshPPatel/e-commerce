@extends('layouts.admin')

@section('title')
    {{ config('app.name') }} | Admin - Products
@endsection

@section('pageHeader')
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Products </h2>
                <p class="pageheader-text">List of available Products in the store.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Products
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
    <!-- ============================================================== -->
    <!-- basic table -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Products</h5>
            <div class="card-body">
              @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-danger mt-1" role="alert">
                        <strong>{{ $error }}</strong>
                    </p>
                @endforeach
              @endif
              @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                  <p>
                    {{ session('error') }}
                  </p>
                </div>
              @endif
              @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                  <p>
                    {{ session('success') }}
                  </p>
                </div>
              @endif
              @if(count($products) > 0)
                  <table class="table table-hover table-bordered table-responsive">
                      <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Product Price</th>
                          <th scope="col">Product Old Price</th>
                          <th scope="col">Product Stock</th>
                          <th scope="col">Description</th>
                          <th scope="col">Sizes</th>
                          <th scope="col">Colors</th>
                          <th scope="col">Datasheets</th>
                          <th scope="col">Images</th>
                          <th scope="col">Sub Category</th>
                          <th scope="col">Category</th>
                          <th scope="col">Reviews</th>
                          <th scope="col">Is Featured?</th>
                          <th scope="col">Product Status</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Delete</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach($products as $product)
                              <tr>
                                  <td scope="col">{{ $loop->index+1 }}</td>
                                  <td scope="col">{{ $product->product_name }}</td>
                                  <td scope="col">{{ $product->product_price }}</td>
                                  <td scope="col">{{ $product->product_old_price == '' ? 'None' : $product->product_old_price }}</td>
                                  <td scope="col">{{ $product->product_stock }}</td>
                                  <td scope="col">{{ $product->product_description }}</td>
                                  <td scope="col">
                                    @if (count($product->productSizes) > 0)
                                        <a href="/user/admin/products/{{ $product->product_id }}/sizes">
                                            <div>
                                                @foreach($product->productSizes as $size)
                                                    @if( $loop->index+1 == count($product->productSizes) )
                                                        {{ $size->product_size }} <br> 
                                                    @else
                                                        {{ $size->product_size }},{{ " " }} 
                                                    @endif
                                                @endforeach
                                            </div>
                                        </a>
                                    @else 
                                        <a class="btn btn-link" href="/user/admin/products/{{ $product->product_id }}/sizes">Add Size</a>
                                    @endif
                                  </td>
                                  <td scope="col">
                                    @if(count($product->productColors) > 0)
                                        @foreach ($product->productColors as $color)
                                            <a href="/user/admin/products/{{ $product->product_id }}/colors">
                                                <div>
                                                    {{ $color->color_name . ' ' }}
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <a class="btn btn-link" href="/user/admin/products/{{ $product->product_id }}/colors">Add Color</a>
                                    @endif
                                  </td>
                                  <td scope="col" class="text-center">
                                    @if(count($product->productDatasheets) > 0)
                                        <a href="/user/admin/products/{{ $product->product_id }}/datasheets">
                                            <div>
                                                {{ count($product->productDatasheets) }}
                                            </div>
                                        </a>
                                    @else
                                        <a class="btn btn-link" href="/user/admin/products/{{ $product->product_id }}/datasheets">Add Datasheet</a>
                                    @endif
                                  </td>
                                  <td scope="col" class="text-center">
                                    @if(count($product->productImages) > 0)
                                        <a href="/user/admin/products/{{ $product->product_id }}/images">
                                            <div>
                                                {{ count($product->productImages) }}
                                            </div>
                                        </a>
                                    @else
                                        <a class="btn btn-link" href="/user/admin/products/{{ $product->product_id }}/images">Add Image</a>
                                    @endif
                                  </td>
                                  <td scope="col">{{ $product->productSubCategory->sub_category_name }}</td>
                                  <td scope="col">{{ $product->productSubCategory->category->category_name }}</td>
                                  <td scope="col">
                                    <a href="/user/admin/product/id/reviews">
                                      24
                                    </a>
                                  </td>
                                  <td scope="col">
                                    @if($product->is_featured == 1)
                                      <span class="text-success">Yes</span>
                                    @else
                                      No
                                    @endif
                                  </td>
                                  <td scope="col">
                                    @if($product->is_available == 1)
                                      <span class="text-success">Available</span>
                                    @else
                                      <span class="text-danger">Hidden</span>
                                    @endif
                                  </td>
                                  <td scope="col">
                                      <a href="/user/admin/products/{{ $product->product_id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                  </td>
                                  <td scope="col">
                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletProductModel{{ $loop->index+1 }}">
                                          Delete
                                      </button>
                                      <!-- Delete category modal -->
                                      <div class="modal fade" id="deletProductModel{{ $loop->index+1 }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Confirm Delete.</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <p class="mtb--10 text-danger">Do you really want to delete the product from the store?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                      <form action="/user/admin/products/{{ $product->product_id }}" method="POST">
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
                      </tbody>
                  </table>
              @else
                  <h4>No Products Found!</h4>
                  <a href="/user/admin/products/create" class="btn btn-primary">Add Product Now!</a>
              @endif
            </div>
        </div>
        <div class="card" style="max-width: 250px; width: 100%;">
            <h5 class="card-header">Quick Suggestions</h5>
            <div class="card-body">
                <a href="/user/admin/products/create" class="btn btn-primary">Add Product</a>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table -->
    <!-- ============================================================== -->
@endsection