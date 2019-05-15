@extends('layouts.admin')

@section('title')
    {{ config('app.name') }} | Admin - Sub Categories
@endsection

@section('pageHeader')
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">
                    @if(empty($pageHeading))
                        Sub Categories
                    @else
                        Sub Categories for {{ $pageHeading }}
                    @endif
                </h2>
                <p class="pageheader-text">List of available Sub Categories in the store.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Sub Categories
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageheader -->
@endsection

@section('content')
    <!-- Add Sub Category Form -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
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
        <div class="card">
            <h5 class="card-header">Add Sub Category</h5>
            <div class="card-body">
                @include('admin.subcategories.addForm')
            </div>
        </div>
    </div>
    <!-- end Add Sub Category Form -->

    <!-- ============================================================== -->
    <!-- basic table -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Sub Categories</h5>
            <div class="card-body">
                @if(count($subCategories) > 0)
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sub Category Name</th>
                            <th scope="col">Parent Category</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subCategories as $subCategory)
                            <tr>
                                <td scope="col">{{ $loop->index+1 }}</td>
                                <td scope="col">{{ $subCategory->sub_category_name }}</td>
                                <td scope="col">{{ $subCategory->category->category_name }}</td>
                                <td scope="col">
                                    @if ($subCategory->sub_category_id == env('OTHERS_SUB_CATEGORY_ID'))
                                        <button href="#" class="btn btn-sm btn-primary" disabled>Edit</button>
                                    @else
                                    <a href="/user/admin/subcategories/{{ $subCategory->sub_category_id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                    @endif
                                </td>
                                <td scope="col">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategoryModal{{ $loop->index+1 }}" {{ $subCategory->sub_category_id == env('OTHERS_SUB_CATEGORY_ID') ? 'disabled' : '' }}>
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
                                                    <p class="mtb--10 text-danger">Do you really want to delete the Category? By deleting this category, all its <strong>sub cateories</strong> and <strong>products</strong> will also be deleted.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                    <form action="/user/admin/subcategories/{{ $subCategory->sub_category_id }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger" {{ $subCategory->sub_category_id == env('OTHERS_SUB_CATEGORY_ID') ? 'disabled' : '' }}>Delete</button>
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
                    <h4>No Sub Categories Found!</h4>
                @endif
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table -->
    <!-- ============================================================== -->
@endsection