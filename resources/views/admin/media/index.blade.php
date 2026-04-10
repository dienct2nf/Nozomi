{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Media')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thư viện hình ảnh</li>
        </ol>
    </nav>
@stop

@section('content')
<iframe src="/filemanager?type=image" style="width: 100%; height: 80vh; overflow: hidden; border: none;"></iframe>
@stop

@section('css')

@stop

@section('js')

@stop
