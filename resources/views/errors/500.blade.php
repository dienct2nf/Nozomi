{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', '500 Internal Server Error')

@section('content_header')
    <h1>500 Internal Server Error</h1>
@stop

@section('content')
<section class="content">
    <div class="error-page">
      <h2 class="headline text-warning"> 404</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! 500 Internal Server Error.</h3>
        <p>
            We could not find the page you were looking for, you may <a href="{{ route('dashboard') }}">return to dashboard</a>
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
