@extends('layouts.admin')

@section('title')
    {{ config('app.name') }} | Admin - Categories
@endsection

@section('pageHeader')
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Categories </h2>
                <p class="pageheader-text">List of available Categories in the store.</p>
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
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Add Category Form -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        @if( session('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Edit Category</h5>
            <div class="card-body">
                @include('admin.categories.editForm')
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end Add Category Form -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- basic table -->
    <!-- ============================================================== -->
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
                                <th scope="row">{{ $loop->index+1 }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <a href="/user/admin/subcategories/category/{{ $category->category_id }}">
                                        <div>
                                            {{ $category->sub_category_count }}
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" disabled>Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" disabled>Delete</button>
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
    <!-- ============================================================== -->
    <!-- end basic table -->
    <!-- ============================================================== -->

@endsection