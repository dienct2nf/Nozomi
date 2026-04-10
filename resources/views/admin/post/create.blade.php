{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.create_post'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">{{ __('label.list_article') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.create_post') }}</li>
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
    {!! Form::open(['route' => 'post.store', 'files' => true]) !!}
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="tab-content" id="myTabContent">
                    @foreach (config('translatable.language') as $key => $item)
                        <div class="tab-pane fade {{ $key == 'vi' ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="language-{{ $key }}">
                            @include('admin.post.partials.form', [
                                'language' => $key,
                                'post' => '',
                                'validated' => $item['validated'],
                                'form_id' => $key.'-form'
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('label.advanced') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    {{ Form::label('parent_id', __('label.status'), ['class' => '']) }}
                                    {{ Form::select('status',config('custom.status'),
                                        'draft',
                                        [
                                            "class" => "form-control",
                                            "id" => "status",
                                        ])
                                    }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    {{ Form::label('category_id', __('label.category'), ['class' => '']) }}
                                    {{ Form::select('category_id[]',$listCategories,
                                        null,
                                        [
                                            "class" => "form-control",
                                            "id" => "category_id",
                                            "multiple" => "multiple"
                                        ])
                                    }}
                                </div>
                            </div>
                            @if($errors->has("category_id"))
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $errors->first("category_id") }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    {{ Form::label('tags', __('label.tags'), ['class' => '']) }}
                                    {{ Form::select('tags[]', $listTags,
                                        null,
                                        [
                                            "class" => "form-control",
                                            "id" => "tags",
                                            "multiple" => "multiple"
                                        ])
                                    }}
                                </div>
                            </div>
                        </div>
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
						<div class="form-group">
                            {{ Form::label("date", __('label.date_create'), ['class' => '']) }}
                            <input id="created_at" type="datetime-local" name="created_at" class="form-control" value="<?php echo date("Y-m-d\TH:i")?>" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="top" name="top">
                                <label for="top" class="custom-control-label">Bài viết nổi bật</label>
                            </div>
                        </div>
                        @can('admin-create')
                            <div class="form-group">
                                <label for="schema" class="control-label">Schema Json</label>
                                    <textarea class="description_link form-control input-char-count " rows="10"
                                    placeholder="Json" name="schema" cols="50"
                                    id="schema"></textarea>
                            </div>
                        @endcan
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
    <script src="/vendor/ckeditor4/ckeditor.js"></script>
    <script src="/vendor/tag/caret.min.js"></script>
    <script src="/vendor/tag/tag-editor.min.js"></script>
    <script>
        var app = new Loader();
        $(function () {
            $('#category_id, #status, #tags').select2();
            app.submitConfirm();
            app.previewGoogle();
            app.removeThumb();
            app.linkingtoSeo();
            app.slugCreate();
            var options = app.appendCkeditor();
            @foreach (config('translatable.language') as $key => $item)
                CKEDITOR.replace('content_{{$key}}', options);
            @endforeach
        })
    </script>
@stop
