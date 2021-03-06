@extends('layouts.admin')

{{-- Page Title --}}
@section('title', `{{ config('app.name') }} | Admin - Categories`)

@section('pageHeader')
  <!-- page Header -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title">Categories</h2>
        <p class="pageheader-text">
          List of available Categories in the store.
        </p>
        <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#" class="breadcrumb-link">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Categories
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
    <!-- Category Form -->
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
        <h5 class="card-header">Add Category</h5>
        <div class="card-body">
          @include('admin.categories.addForm')
        </div>
      </div>
      <!-- End Form Card -->

    </div>
    <!-- End of Category Form -->

    <!-- Categories List Table -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
      <div class="card">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
          @if(count($categories) > 0)
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Number Of Sub Categories</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td scope="col">{{ $loop->index+1 }}</td>
                    <td scope="col">{{ $category->category_name }}</td>
                    <td scope="col">
                      <a href="/user/admin/subcategories/category/{{ $category->category_id }}" style="text-decoration: underline;">
                        <div style="width: 100%; height: 100%">
                          {{ count($category->subCategories) }}
                        </div>
                      </a>
                    </td>
                    <td scope="col">
                      <a href="/user/admin/categories/{{ $category->category_id }}/edit" class="btn btn-sm btn-primary">
                        Edit
                      </a>
                    </td>
                    <td scope="col">
                      <!-- Button trigger modal -->
                      <button 
                        type="button" 
                        class="btn btn-danger btn-sm" 
                        data-toggle="modal" 
                        data-target="#deleteCategoryModal{{ $loop->index+1 }}">
                          Delete
                      </button>
                      <!-- Delete category modal -->
                      <div class="modal fade" id="deleteCategoryModal{{ $loop->index+1 }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirm Delete.</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p class="mtb--10 text-danger">
                                Do you really want to delete the Category? By deleting this category, all its <strong>sub cateories</strong> and <strong>products</strong> will also be deleted.
                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                              <form action="/user/admin/categories/{{ $category->category_id }}" method="POST">
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
            <h4>No Categories Found!</h4>
          @endif
        </div>
      </div>
    </div>
@endsection