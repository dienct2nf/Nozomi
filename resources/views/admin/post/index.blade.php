{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.list_article'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.list_article') }}</li>
        </ol>
    </nav>
@stop

@section('content')
@if ($message = Session::get('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{ __('label.article') }}</span>
                    <div class="pull-right">
                        <a class="btn btn-success btn-sm" href="{{ route('post.create') }}"> <span class="fa fa-plus"></span> {{ __('label.add') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('label.thumb') }}</th>
                                    <th>{{ __('label.title') }}</th>
                                    <th>{{ __('label.description') }}</th>
                                    <th>{{ __('label.category') }}</th>
                                    <th>{{ __('label.view_count') }}</th>
                                    <th>{{ __('label.date_create') }}</th>
                                    <th>{{ __('label.author') }}</th>
                                    <th width="100px">{{ __('label.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset("vendor/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
@stop
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('js')
    <script>
        var app = new Loader();
        $(function () {
            app.submitConfirm();
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    "url": "{{ route('post.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', 'width': '30'},
                    {data: 'img', name: 'img', 'width': '80', 'render': function (data, type, full, meta) {
                        return "<img src=\"" + data + "\" height=\"60\"/>";
                    },},
                    {data: 'title', name: 'title', width: '200'},
                    {data: 'description', name: 'description'},
                    {data: 'category', name: 'category', width: '150'},
                    {data: 'view_count', name: 'view_count', width: '80'},
                    {data: 'created_at', name: 'created_at', width: '70'},
                    {data: 'author.name', name: 'author.name', width: '80'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@stop
