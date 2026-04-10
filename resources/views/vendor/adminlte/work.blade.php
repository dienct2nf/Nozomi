@extends('adminlte::master')

@section('adminlte_css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/custom/css/custom.css') }}" >
<style>
    .invalid-feedback {
        display: block !important;
    }
</style>
    @stack('css')
    @yield('css')
@stop


@section('body')
<div class="content">
    <div class="{{config('adminlte.classes_content', 'container-fluid')}}">
        @yield('content')
    </div>
</div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/custom/js/main.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
