{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.create_product'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('label.list_product') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.create_product') }}</li>
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
    {!! Form::open(['route' => 'product.store', 'files' => true]) !!}
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="tab-content" id="myTabContent">
                    <div class="card">
                        <div class="card-header">
                            <span>{{ __('label.content_product') }}</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {{ Form::label("name", __('label.career'), ['class' => 'required']) }}
                                <div class="count_char">
                                    {{ Form::text("name",
                                                old("name") ? old("name") : (!empty($product) ? $product->name : null),
                                                [
                                                    "class" => 'google-preview form-control input-char-count' . ( $errors->has('name') ? ' is-invalid' : '' ),
                                                    "placeholder" => __('label.career'),
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
                                                old("description") ? old("description") : (!empty($product) ? $product->description : null),
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
                            <div class="form-group">
                                {{ Form::label("content", __('label.body'), ['class' => 'required']) }}
                                {{ Form::textarea("content",
                                            old("content") ? old("content") : (!empty($product) ? $product->content : null),
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
                                    {{ Form::select('status',config('custom.status_product'),
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
                            {{ Form::label("slot", __('label.slot'), ['class' => 'required']) }}
                            {{ Form::number("slot",
                                        old("slot") ? old("slot") : (!empty($product) ? $product->slot : null),
                                        [
                                            "class" => 'form-control' . ( $errors->has('slot') ? ' is-invalid' : '' ),
                                            "placeholder" => __('label.slot'),
                                        ])
                            }}
                            @if($errors->has("slot"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("slot") }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label("workplace", __('label.workplace'), ['class' => 'required']) }}
                            {{ Form::text("workplace",
                                        old("workplace") ? old("workplace") : (!empty($product) ? $product->workplace : null),
                                        [
                                            "class" => 'form-control' . ( $errors->has('workplace') ? ' is-invalid' : '' ),
                                            "placeholder" => __('label.workplace'),
                                        ])
                            }}
                            @if($errors->has("workplace"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("workplace") }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label("price", __('label.salary'), ['class' => 'required']) }}
                            {{ Form::text("price",
                                        old("price") ? old("price") : (!empty($product) ? $product->price : null),
                                        [
                                            "class" => 'form-control' . ( $errors->has('price') ? ' is-invalid' : '' ),
                                            "placeholder" => __('label.salary'),
                                            "data-inputmask" =>"'alias': 'decimal', 'rightAlign': 'false', 'groupSeparator': '.', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'placeholder': ''",
                                        ])
                            }}
                            @if($errors->has("price"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("price") }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label("date", __('label.recruitment_date'), ['class' => 'required']) }}
                            {{ Form::text("date",
                                        old("date") ? old("date") : (!empty($product) ? $product->date : null),
                                        [
                                            "class" => 'form-control' . ( $errors->has('date') ? ' is-invalid' : '' ),
                                            "placeholder" => __('label.recruitment_date'),
                                            "data-inputmask-alias" => "datetime",
                                            "data-inputmask-inputformat" => "dd/mm/yyyy",
                                            "data-mask" => "",
                                        ])
                            }}
                            @if($errors->has("date"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("date") }}
                                </div>
                            @endif
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
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="top" name="top">
                                <label for="top" class="custom-control-label">Đơn hàng nổi bật</label>
                            </div>
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
    <script src="/vendor/ckeditor4/ckeditor.js"></script>
    <!-- InputMask -->
    <script src="/vendor/input-mask/moment.min.js"></script>
    <script src="/vendor/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script>
        var app = new Loader();
        $(function () {
            $('#category_id, #status').select2();
            $("#price").inputmask();
            $('#date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            app.submitConfirm();
            app.previewGoogleProduct();
            app.removeThumb();
            var options = app.appendCkeditor();
                CKEDITOR.replace('content', options);
        })
    </script>
@stop
