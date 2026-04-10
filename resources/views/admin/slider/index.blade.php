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
                    <div class="pull-right">
                            {{ Form::select('parent_id',$group,
                                old("parent_id") ? old("parent_id") : (!empty($slider) ? $slider->parent_id : null),
                                [
                                    "class" => 'form-control ' . ( $errors->has('parent_id') ? ' is-invalid' : '' ),
                                    "id" => "parent_id"
                                ])
                            }}
                            @if($errors->has("parent_id"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("permission") }}
                                </div>
                            @endif
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach (config('translatable.language') as $key => $item)
                            <li class="nav-item">
                                <a class="nav-link {{ $key == 'vi' ? 'active' : '' }}" id="language-{{ $key }}" data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}" aria-selected="true"><img alt="lang" src="{{ asset($item['img']) }}"> {{ $item['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach (config('translatable.language') as $key => $item)
                            <div class="tab-pane fade {{ $key == 'vi' ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="language-{{ $key }}">
                                @include('admin.slider.partials.index', [
                                    'language' => $key,
                                    'slider' => $slider,
                                    'validated' => $item['validated'],
                                    'form_id' => $key.'-form'
                                ])
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        {{ Form::label('lfm', 'Thumbnail', ['class' => '']) }}
                        <div class="showthumb">
                            <span id="delete-thumb" data-toggle="tooltip" title="Delete Thumbnail" class="showthumb--delete"><i class="fas fa-minus-circle"></i></span>
                            <input id="thumbnail" name="image" class="form-control" type="hidden">
                            <div id="lfm" data-input="thumbnail" data-preview="holder">
                                <img id="holder" class="showthumb--beautifull" src="{{  (!empty($slider)? trim($slider->img) !=='' ? '/uploads/'.$slider->img :\setting('noimage') : \setting('noimage')) }}">
                            </div>
                        </div>
                        @if($errors->has("image"))
                            <div class="invalid-feedback" style="display: block">
                                {{ $errors->first("image") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label("link", 'Link', ['class' => 'required control-label']) }}
                        {{ Form::text("link",
                                    old("link") ? old("link") : (!empty($slider) ? $slider->link : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('link') ? ' is-invalid' : '' ),
                                        "placeholder" => "Link",
                                    ])
                        }}
                        @if($errors->has("link"))
                            <div class="invalid-feedback">
                                {{ $errors->first("link") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label("order", 'Order', ['class' => 'required control-label']) }}
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
                                    <th>Order</th>
                                    <th>Img</th>
                                    <th>Name</th>
                                    <th>Group</th>
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
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
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
                    {data: 'order', name: 'order', width: '30'},
                    {data: 'img', name: 'img', 'width': '120', 'render': function (data, type, full, meta) {
                        return "<img src=\"" + data + "\" height=\"100\"/>";
                    },},
                    {data: 'title', name: 'title'},
                    {data: 'group', name: 'group', width: '50'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#parent_id').change(function(){
                dataTable.draw();
            });
        });
    </script>
@stop

