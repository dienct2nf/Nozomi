{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Setting')

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Setting</li>
    </ol>
</nav>  
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-12">
            @if ($message = Session::get('status'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5>Setting</h5>
                </div>
                <div class="card-body">
                @if(count(config('setting_fields', [])) )
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach(config('setting_fields') as $section => $fields)
                            <li class="nav-item">
                                <a class="nav-link {{ $section == 'app'? 'active' : '' }}" id="tab-{{ $section }}" data-toggle="tab" href="#{{ $section }}" role="tab" aria-controls="home" aria-selected="true"> <i class="{{ Arr::get($fields, 'icon', 'fa fa-th-large') }}"></i> {{ $fields['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach(config('setting_fields') as $section => $fields)
                            <div class="tab-pane {{ $section == 'app'? 'active' : '' }}" id="{{ $section }}" role="tabpanel" aria-labelledby="tab-{{ $section }}">
                                <div class="form-group mt-3">
                                    <p class="card-text">{{ $fields['desc'] }}</p>
                                </div>
                                <form id="{{ $section }}" method="post" action="{{ route('setting.store') }}" class="form-horizontal" role="{{ $section }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="tab" value="{{ $section }}">
                                    <div class="col-md-12">
                                        @foreach($fields['elements'] as $field)
                                            @includeIf('admin.setting.partials.fields.' . $field['type'] )
                                        @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn-primary btn">
                                            Save Settings
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/vendor/ckeditor4/ckeditor.js"></script>
    @if ($tab = Session::get('tab') )
        <script>
            $(document).ready(function() {
                $('#tab-{{ $tab }}').click();
            });
        </script>
    @endif
@stop
