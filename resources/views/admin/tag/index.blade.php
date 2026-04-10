{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Từ khóa')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Từ khóa</li>
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
            <div class="row">
                <div class="col-md-6">
                    @if (empty($tag))
                        {!! Form::open(['route' => 'tag.store', 'files' => true]) !!}
                        <div class="form-group">
                            {{ Form::label("tags", __('label.tags'), ['class' => 'control-label']) }}
                            <div class="count_char">
                                {{ Form::text("tags",
                                            old("tags") ? old("tags") : (!empty($tag) ? $tag->title : null),
                                            [
                                                "class" => 'form-control',
                                                "placeholder" => "tags",
                                                "style" => "padding: 50px 5px 50px 0px;",

                                            ])
                                }}
                            </div>
                        </div>
                    @else
                    <div class="form-group">
                        {!! Form::model($tag, ['route' => ['tag.update', $tag->id], 'files' => true]) !!}
                        {{ method_field('PUT') }}
                        <div class="count_char">
                            {{ Form::text("title",
                                        old("title") ? old("title") : (!empty($tag) ? $tag->title : null),
                                        [
                                            "class" => 'form-control',
                                            "placeholder" => "title",

                                        ])
                            }}
                        </div>
                    </div>
                    @endif
                        <div class="form-group">
                            {{ Form::submit(__('label.save'), ['class' => 'btn btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span>{{ __('label.article') }}</span>
                            <div class="pull-right">
                                <a class="btn btn-success btn-sm" href="{{ route('tag.create') }}"> <span class="fa fa-plus"></span> {{ __('label.add') }}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('label.title') }}</th>
                                            <th>Tạo lúc</th>
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
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset("vendor/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/tag/tag-editor.css") }}">
    <style>
        .tag-editor {
            padding: 50px 0;
        }
    </style>
@stop
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('js')
<script src="/vendor/tag/caret.min.js"></script>
<script src="/vendor/tag/tag-editor.min.js"></script>
    <script>
        $('#tags').tagEditor({
            placeholder: 'Enter tags ...'
        });
        var app = new Loader();
        $(function () {
            app.submitConfirm();
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    "url": "{{ route('tag.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', 'width': '30'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at', width: '80'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@stop
