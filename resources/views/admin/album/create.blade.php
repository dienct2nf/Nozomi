{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.create_album'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('label.list_album') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.create_album') }}</li>
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
    {!! Form::open(['route' => 'album.store', 'files' => true]) !!}
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="tab-content" id="myTabContent">
                    <div class="card">
                        <div class="card-header">
                            <span>{{ __('label.content_album') }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label("name", __('label.title'), ['class' => 'required']) }}
                                                <div class="count_char">
                                                    {{ Form::text("name",
                                                                old("name") ? old("name") : (!empty($album) ? $album->name : null),
                                                                [
                                                                    "class" => 'google-preview form-control input-char-count' . ( $errors->has('name') ? ' is-invalid' : '' ),
                                                                    "placeholder" => __('label.title'),
                                                                    "maxlength" => "120",
                                                                ])
                                                    }}
                                                </div>
                                                @if($errors->has("name"))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first("name") }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label("description", __('label.description'), ['class' => 'required']) }}
                                                <div class="count_char">
                                                    {{ Form::textarea("description",
                                                                old("description") ? old("description") : (!empty($album) ? $album->description : null),
                                                                [
                                                                    "class" => 'form-control google-preview input-char-count ' . ( $errors->has('description') ? ' is-invalid' : '' ),
                                                                    "rows" => "3",
                                                                    "placeholder" => __('label.description'),
                                                                    "maxlength" => \setting('description_length'),
                                                                ])
                                                    }}
                                                </div>
                                                @if($errors->has("description"))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first("description") }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('lfm', __('label.thumb'), ['class' => '']) }}
                                                <div class="showthumb">
                                                    <span id="delete-thumb" data-toggle="tooltip" title="Delete Thumbnail" class="showthumb--delete"><i class="fas fa-minus-circle"></i></span>
                                                    <input id="thumbnail" name="image" class="form-control" type="hidden">
                                                    <div id="lfm" data-input="thumbnail" data-preview="holder">
                                                        <img id="holder" class="showthumb--beautifull" src="{{ \setting('noimage') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label("content", __('label.body'), ['class' => 'required']) }}
                                {{ Form::textarea("content",
                                            old("content") ? old("content") : (!empty($album) ? $album->content : null),
                                            [
                                                "class" => 'form-control ' . ( $errors->has('content') ? ' is-invalid' : '' ),
                                                "rows" => "5",
                                                "id" => "content",
                                                "placeholder" => __('label.body'),
                                            ])
                                }}
                                @if($errors->has("content"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("content") }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <span>{{ __('label.p_seo') }}</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @include('admin.product.partials.google')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('label.image_album') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="multi_image" data-input="thumbnail_m" data-preview="holder_m" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Chọn hình ảnh
                                  </a>
                                </span>
                                <input id="thumbnail_m" class="form-control" type="text" name="album" readonly>
                              </div>
                            <div class="container">
                                <div class="row">
                                    <div class="img-grid" id="holder_m">
                                    </div>
                                </div>
                            </div>
                            @if($errors->has("album"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("album") }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('label.save'), ['class' => 'btn btn-primary']) }}
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
@section('plugins.Select2', true)
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
            $('#multi_image').filemanager_button('image');
            $('#category_id, #status').select2();
            app.submitConfirm();
            app.previewGoogleProduct();
            app.removeThumb();
            app.removeThumbAlbum();
            app.deleteImg();
            var options = app.appendCkeditor();
                CKEDITOR.replace('content', options);
        })
    </script>
@stop
