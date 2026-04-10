{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', __('label.create_category'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.create') }}">{{ __('label.list_category') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('label.create_category') }}</li>
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
    {!! Form::open(['route' => 'category.store', 'files' => true]) !!}
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="tab-content" id="myTabContent">
                    @foreach (config('translatable.language') as $key => $item)
                        <div class="tab-pane fade {{ $key == 'vi' ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="language-{{ $key }}">
                            @include('admin.category.partials.form', [
                                'language' => $key,
                                'category' => '',
                                'validated' => $item['validated'],
                                'form_id' => $key.'-form'
                            ])
                        </div>
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('label.advanced') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    {{ Form::label('parent_id', __('label.category'), ['class' => '']) }}
                                    {{ Form::select('parent_id',$listCategories,
                                        0,
                                        [
                                            "class" => "form-control",
                                            "id" => "parent_id",
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
                            {{ Form::submit(__('label.save'), ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('label.category') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('label.thumb') }}</th>
                                            <th>{{ __('label.title') }}</th>
                                            <th>{{ __('label.description') }}</th>
                                            <th>Số bài</th>
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
@section('plugins.CountChar', true)
@section('js')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        var app = new Loader();
        $(function () {
            $('#parent_id').select2();
            app.submitConfirm();
            app.previewGoogle();
            app.removeThumb();
            app.slugCreate();
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    "url": "{{ route('category.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', width: '30'},
                    {data: 'img', name: 'img', 'width': '80', 'render': function (data, type, full, meta) {
                        return "<img src=\"" + data + "\" height=\"60\"/>";
                    },},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'post', name: 'post', width: '80'},
                    {data: 'author.name', name: 'author', width: '80'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@stop
