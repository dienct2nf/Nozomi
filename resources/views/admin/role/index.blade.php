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
    @if (empty($role))
        {!! Form::open(['route' => 'role.store', 'files' => true]) !!}
    @else
        {!! Form::model($role, ['route' => ['role.update', $role->id], 'files' => true]) !!}
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
                                    old("name") ? old("name") : (!empty($role) ? $role->name : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('name') ? ' is-invalid' : '' ),
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
                                    old("description") ? old("description") : (!empty($role) ? $role->description : null),
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
                                {{ Form::label('permission', 'Permission group', ['class' => '']) }}
                                {{ Form::select('permission[]',$permission,
                                    old("permission") ? old("permission") : (!empty($role) ? $permission_ids = $role->permissions->map(function($item)
                                                {
                                                    return $item->id;
                                                }) : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('permission') ? ' is-invalid' : '' ),
                                        "id" => "permission",
                                        "multiple" => "multiple"
                                    ])
                                }}
                                @if($errors->has("permission"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("permission") }}
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
                        @if (!empty($role))
                        <div class="pull-right">
                            <a class="btn btn-success btn-sm" href="{{ route('role.index') }}"> <span class="fa fa-plus"></span> Add new</a>
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
                                            <th>Permission</th>
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
            $('#permission').select2();
            app.submitConfirm();
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    "url": "{{ route('role.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', width: '30'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'permissions', name: 'permissions'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@stop
