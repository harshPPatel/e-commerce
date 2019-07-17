@extends('layouts.app')

@section('content')

    {{-- Offset Modals --}}
    @include('includes.offsetModals')

    {{-- Feature Product and Browse Category --}}
    @include('includes.pages.index.feature')

    {{-- Our Products Section --}}
    @include('includes.pages.index.ourProducts', ['category' => $electronicCategory, 'modalSizes' => false])
    
    {{-- Our Products Section --}}
    @include('includes.pages.index.ourProducts', ['category' => $menFashionCategory, 'modalSizes' => true])
    
    {{-- Our Products Section --}}
    @include('includes.pages.index.ourProducts', ['category' => $womenFashionCategory, 'modalSizes' => true])

@endsection