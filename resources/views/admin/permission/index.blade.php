{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', $text)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$text}}</li>
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
    @if (empty($permission))
        {!! Form::open(['route' => 'permission.store', 'files' => true]) !!}
    @else
        {!! Form::model($permission, ['route' => ['permission.update', $permission->id], 'files' => true]) !!}
        {{ method_field('PUT') }}
    @endif
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <span>{{$text}}</span>
                    </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label("name", 'Name', ['class' => 'required', 'control-label']) }}
                        {{ Form::text("name",
                                    old("name") ? old("name") : (!empty($permission) ? $permission->name : null),
                                    [
                                        "class" => 'google-preview form-control ' . ( $errors->has('name') ? ' is-invalid' : '' ),
                                        "placeholder" => "Title",
                                    ])
                        }}
                        @if($errors->has("name"))
                            <div class="invalid-feedback">
                                {{ $errors->first("name") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label("description", 'Description', ['class' => 'required', 'control-label']) }}
                        {{ Form::textarea("description",
                                    old("description") ? old("description") : (!empty($permission) ? $permission->description : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('description') ? ' is-invalid' : '' ),
                                        "rows" => "5",
                                        "placeholder" => "description",
                                    ])
                        }}
                        @if($errors->has("description"))
                            <div class="invalid-feedback">
                                {{ $errors->first("description") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                {{ Form::label('role', 'Roles management', ['class' => '']) }}
                                {{ Form::select('role[]',$role,
                                    old("role") ? old("role") : (!empty($permission) ? $role_ids = $permission->roles->map(function($item)
                                                {
                                                    return $item->id;
                                                }) : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('role') ? ' is-invalid' : '' ),
                                        "id" => "role",
                                        "multiple" => "multiple"
                                    ])
                                }}
                                @if($errors->has("role"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("role") }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
            </div>
        </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>Roles</span>
                        @if (!empty($permission))
                            <div class="pull-right">
                                <a class="btn btn-success btn-sm" href="{{ route('permission.index') }}"> <span class="fa fa-plus"></span> Add new</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Roles</th>
                                            <th width="100px">Action</th>
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
    {!! Form::close() !!}
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
            $('#role').select2();
            app.submitConfirm();
            app.uniquePermission('name');
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    "url": "{{ route('permission.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', width: '30'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'roles', name: 'roles'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@stop
