{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.list_customer'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.list_customer') }}</li>
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
                    <span>{{ __('label.customer') }}</span>
                    <div class="pull-right">
                        <a class="btn btn-success btn-sm" href="{{ route('customer.export') }}"> <span class="fa fa-table"></span> {{ __('label.excel') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('label.fullname') }}</th>
                                    <th>{{ __('label.birthday') }}</th>
                                    <th>{{ __('label.address') }}</th>
                                    <th>{{ __('label.product') }}</th>
                                    <th>{{ __('label.phone') }}</th>
                                    <th>{{ __('label.date_create') }}</th>
                                    <th>{{ __('label.sex') }}</th>
                                    <th>{{ __('label.status') }}</th>
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

@stop
@section('plugins.Datatables', true)
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
                    "url": "{{ route('customer.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', 'width': '30'},
                    // {data: 'img', name: 'img', 'width': '80', 'render': function (data, type, full, meta) {
                    //     return "<img src=\"" + data + "\" height=\"60\"/>";
                    // },},
                    {data: 'full_name', name: 'full_name', width: '120'},
                    {data: 'birth_day', name: 'birth_day', width: '100'},
                    {data: 'address', name: 'address'},
                    {data: 'donhang', name: 'donhang'},
                    {data: 'phone', name: 'phone', width: '100'},
                    {data: 'created_at', name: 'created_at', width: '100'},
                    {data: 'sex', name: 'sex', width: '80'},
                    {data: 'status', name: 'status', width: '80'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
        jQuery(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@stop
