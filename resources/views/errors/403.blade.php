{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'No Permission')

@section('content_header')
    <h1>403 Error Page</h1>
@stop

@section('content')
<section class="content">
    <div class="error-page">
      <h2 class="headline text-warning"> 403</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! No Permission.</h3>

        <p>
          You do not have permission to access this page please contact admin, you may <a href="{{ route('dashboard') }}">return to dashboard</a>
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
