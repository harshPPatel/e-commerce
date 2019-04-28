@extends('layouts.app')

@section('content')

    {{-- Offset Modals --}}
    @include('includes.offsetModals')

    {{-- Feature Product and Browse Category --}}
    @include('includes.pages.index.feature')

    {{-- Banner --}}
    @include('includes.pages.index.banner')

    {{-- Our Products Section --}}
    @include('includes.pages.index.ourProducts')

    {{-- Banner --}}
    @include('includes.pages.index.banner')

    {{-- Our Products Section --}}
    @include('includes.pages.index.ourProducts')

    {{-- Banner --}}
    @include('includes.pages.index.banner')

    {{-- Our Products Section --}}
    @include('includes.pages.index.ourProducts')

@endsection

@section('modals')
    @include('includes.modals.quickProduct')
@endsection