{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Menu')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Menu</li>
        </ol>
    </nav> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <span>Setting Menu</span>
        </div>
        <div class="card-body">
            {!! Menu::render() !!}
        </div>
    </div>
@stop
@section('js')
{!! Menu::scripts() !!}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@stop
