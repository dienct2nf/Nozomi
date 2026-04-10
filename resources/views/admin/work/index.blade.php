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
            @if (empty($slider))
                {!! Form::open(['route' => 'slider.store', 'files' => true]) !!}
            @else
                {!! Form::model($slider, ['route' => ['slider.update', $slider->id], 'files' => true]) !!}
                {{ method_field('PUT') }}
            @endif
            <div class="card">
                <div class="card-header">
                    <span>Slider Group</span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label("title", 'Title', ['class' => [$validated? 'required' : '', 'control-label']]) }}
                        {{ Form::text("title",
                                    old("title") ? old("title") : (!empty($slider) ? $slider->title : null),
                                    [
                                        "class" => 'google-preview form-control ' . ( $errors->has('title') ? ' is-invalid' : '' ),
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
                                    old("description") ? old("description") : (!empty($slider) ? $slider->description : null),
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
                        {{ Form::label("order", 'Order', ['class' => 'control-label']) }}
                        {{ Form::number("order",
                                    old("order") ? old("order") : (!empty($slider) ? $slider->order : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('order') ? ' is-invalid' : '' ),
                                        "placeholder" => "Order",
                                    ])
                        }}
                        @if($errors->has("order"))
                            <div class="invalid-feedback">
                                {{ $errors->first("order") }}
                            </div>
                        @endif
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
                <h5>Slider</h5>
                @if (!empty($slider))
                <div class="pull-right">
                    <a class="btn btn-success btn-sm" href="{{ route('slider.index') }}"> <span class="fa fa-plus"></span> Add new</a>
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
    @if ($tab = Session::get('tab') )
        <script>
            $(document).ready(function() {
                $('#tab-{{ $tab }}').click();
            });
        </script>
    @endif
    <script>
        var app = new Loader();
        $(function () {
            app.submitConfirm();
            app.uniquePermission('name');
            app.removeThumb();
            var dataTable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ordering: false,
                ajax: {
                    "url": "{{ route('slider.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'data': function(data) {
                        // Read values
                        var parent = $('#parent_id option:selected').text();
                        // Append to data
                        data.group = parent;
                    }
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

