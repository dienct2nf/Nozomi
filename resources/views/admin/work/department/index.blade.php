{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', $text)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $text }}</li>
    </ol>
</nav>
@stop
@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            @if ($message = Session::get('status'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (empty($department))
                {!! Form::open(['route' => 'work.department.store', 'files' => true]) !!}
            @else
                {!! Form::model($department, ['route' => ['work.department.update', $department->id], 'files' => true]) !!}
                {{ method_field('PUT') }}
            @endif
            <div class="card">
                <div class="card-header">
                    <span>Department</span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label("title", 'Title', ['class' => 'control-label']) }}
                        {{ Form::text("title",
                                    old("title") ? old("title") : (!empty($department) ? $department->title : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('title') ? ' is-invalid' : '' ),
                                        "placeholder" => "Title",
                                    ])
                        }}
                        @if($errors->has("title"))
                            <div class="invalid-feedback">
                                {{ $errors->first("title") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label("description", 'Description', ['class' => 'control-label']) }}
                        {{ Form::textarea("description",
                                    old("description") ? old("description") : (!empty($department) ? $department->description : null),
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
                                {{ Form::label('manage_id', 'Trưởng phòng', ['class' => '']) }}
                                {{ Form::select('manage_id', $listUsers,
                                    (!empty($department) ? $department->manage_id : null),
                                    [
                                        "class" => "form-control",
                                        "id" => "manage_id",
                                    ])
                                }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                {{ Form::label('parent_id','Phòng ban', ['class' => '']) }}
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="0">None</option>
                                    @foreach ($listDepartments as $item)
                                        <option value="{{ $item->id }}" {{ !empty($department)? $department->parent_id == $item->id? 'selected' : '' : ''}}>{{ $item->title }} </option>
                                        @if ($item->children()->count() > 0)
                                            @foreach ($item->children as $row)
                                                <option value="{{ $row->id }}" {{ !empty($department)? $department->parent_id == $row->id? 'selected' : '' : '' }}>--- {{ $row->title }} </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('active', 'Active', ['class' => '']) }}
                        {{ Form::checkbox('active', '1', true, ['class' => ''] ) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>List phòng ban</h5>
                @if (!empty($department))
                <div class="pull-right">
                    <a class="btn btn-success btn-sm" href="{{ route('work.department.index') }}"> <span class="fa fa-plus"></span> Thêm mới</a>
                </div>
            @endif
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên phòng ban</th>
                                    <th>Mô tả</th>
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
</div>
@stop
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('js')
<script>
    var app = new Loader();
    $(function () {
        app.submitConfirm();
        var dataTable = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                "url": "{{ route('work.department.loadData') }}",
                "type": "get",
                "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@stop

