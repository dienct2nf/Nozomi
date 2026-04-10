{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.create_widget'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('label.list_widget') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.create_widget') }}</li>
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
        @if (empty($widget))
        {!! Form::open(['route' => 'widget.store', 'files' => true]) !!}
        @else
        {!! Form::model($widget, ['route' => ['widget.update', $widget->id], 'files' => true]) !!}
        {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="tab-content" id="myTabContent">
                    <div class="card">
                        <div class="card-header">
                            <span>{{ __('label.content_widget') }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label("title", __('label.title'), ['class' => 'required']) }}
                                        <div class="count_char">
                                            {{ Form::text("title",
                                                        old("title") ? old("title") : (!empty($widget) ? $widget->title : null),
                                                        [
                                                            "class" => 'form-control input-char-count' . ( $errors->has('title') ? ' is-invalid' : '' ),
                                                            "placeholder" => __('label.title'),
                                                            "maxlength" => "120",
                                                        ])
                                            }}
                                        </div>
                                        @if($errors->has("title"))
                                            <div class="invalid-feedback">
                                                {{ $errors->first("title") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label("description", __('label.body'), ['class' => 'required']) }}
                                {{ Form::textarea("description",
                                            old("description") ? old("description") : (!empty($widget) ? $widget->description : null),
                                            [
                                                "class" => 'form-control ' . ( $errors->has('description') ? ' is-invalid' : '' ),
                                                "rows" => "5",
                                                "id" => "description",
                                                "placeholder" => __('label.body'),
                                            ])
                                }}
                                @if($errors->has("description"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("description") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::submit(__('label.save'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('label.list_widget') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('label.title') }}</th>
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
    {!! Form::close() !!}
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset("vendor/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/tag/tag-editor.css") }}">
@stop
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.CountChar', true)
@section('js')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button-custom.js"></script>
    <script src="/vendor/ckeditor4/ckeditor.js"></script>
    <!-- InputMask -->
    <script>
        var app = new Loader();
        $(function () {
            app.submitConfirm();
            app.previewGoogleProduct();
            app.removeThumb();
            app.removeThumbAlbum();
            app.deleteImg();
            var options = app.appendCkeditor();
                CKEDITOR.replace('description', options);
            var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                "url": "{{ route('widget.loadData') }}",
                "type": "get",
                "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                {data: 'id', name: 'id', width: '30'},
                {data: 'title', name: 'title'},
                {data: 'author.name', name: 'author.name', width: '80'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        })
    </script>
@stop
