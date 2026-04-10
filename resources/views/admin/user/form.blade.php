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
@if ($message = Session::get('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    @if (empty($user))
        {!! Form::open(['route' => 'user.store', 'files' => true]) !!}
    @else
        {!! Form::model($user, ['route' => ['user.update', $user->id], 'files' => true]) !!}
        {{ method_field('PUT') }}
    @endif
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Infomation</h4>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('lfm', 'Avatar', ['class' => '']) }}
                            <div class="showthumb">
                                <span id="delete-thumb" data-toggle="tooltip" title="Delete Thumbnail" class="showthumb--delete"><i class="fas fa-minus-circle"></i></span>
                                <input id="thumbnail" name="image" class="form-control" type="hidden">
                                <div id="lfm" data-input="thumbnail" data-preview="holder">
                                    <img id="holder" class="showthumb--beautifull" src="{{ (!empty($user) ? !is_null($user->img)? '/uploads/'.$user->img : '/vendor/image/no-avatar.png' : '/vendor/image/no-avatar.png') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group col-12">
                            {{ Form::label('job_id', 'Job', ['class' => 'required']) }}
                            {{ Form::select('job_id', $jobs,
                                (!empty($user) ? $user->job_id : null),
                                [
                                    "class" => "form-control",
                                    "id" => "job_id",
                                ])
                            }}
                        </div>
                        @if($errors->has("job_id"))
                            <div class="invalid-feedback" style="display: block">
                                {{ $errors->first("job_id") }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {{ Form::label("firstname", 'First Name', ['class' => 'required control-label']) }}
                                    {{ Form::text("firstname",
                                                old("firstname") ? old("firstname") : (!empty($user) ? $user->firstname : null),
                                                [
                                                    "class" => 'google-preview form-control ' . ( $errors->has('firstname') ? ' is-invalid' : '' ),
                                                    "placeholder" => "First Name",
                                                ])
                                    }}
                                    @if($errors->has("firstname"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("firstname") }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label("phone", 'Phone number', ['class' => 'control-label']) }}
                                    {{ Form::text("phone",
                                                old("phone") ? old("phone") : (!empty($user) ? $user->phone : null),
                                                [
                                                    "class" => 'google-preview form-control ' . ( $errors->has('phone') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Phone number",
                                                ])
                                    }}
                                    @if($errors->has("phone"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("phone") }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label("address", 'Address', ['class' => 'control-label']) }}
                                    {{ Form::text("address",
                                                old("address") ? old("address") : (!empty($user) ? $user->address : null),
                                                [
                                                    "class" => 'google-preview form-control ' . ( $errors->has('address') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Address",
                                                ])
                                    }}
                                    @if($errors->has("address"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("address") }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {{ Form::label("lastname", 'Last Name', ['class' => 'required control-label']) }}
                                    {{ Form::text("lastname",
                                                old("lastname") ? old("lastname") : (!empty($user) ? $user->lastname : null),
                                                [
                                                    "class" => 'google-preview form-control ' . ( $errors->has('lastname') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Last Name",
                                                ])
                                    }}
                                    @if($errors->has("lastname"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("lastname") }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label("email", 'Email', ['class' => 'required control-label']) }}
                                    {{ Form::text("email",
                                                old("email") ? old("email") : (!empty($user) ? $user->email : null),
                                                [
                                                    "class" => 'google-preview form-control ' . ( $errors->has('email') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Email",
                                                ])
                                    }}
                                    @if($errors->has("email"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("email") }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label("facebook", 'Facebook', ['class' => 'control-label']) }}
                                    {{ Form::text("facebook",
                                                old("facebook") ? old("facebook") : (!empty($user) ? $user->facebook : null),
                                                [
                                                    "class" => 'google-preview form-control ' . ( $errors->has('facebook') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Facebook",
                                                ])
                                    }}
                                    @if($errors->has("facebook"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("email") }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("description", 'Description', ['class' => 'control-label']) }}
                            {{ Form::textarea("description",
                                        old("description") ? old("description") : (!empty($user) ? $user->description : null),
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
                            {{ Form::select('department_id', $departments,
                                (!empty($user) ? $user->department_id : null),
                                [
                                    "class" => "form-control",
                                    "id" => "department_id",
                                ])
                            }}
                        </div>
                        @if($errors->has("department_id"))
                            <div class="invalid-feedback" style="display: block">
                                {{ $errors->first("department_id") }}
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Change password</h4>
                </div>
                    <div class="card-body row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label("password", 'New password', ['class' => (empty($user)? 'required' : '').' control-label']) }}
                                {{ Form::password("password",
                                            [
                                                "class" => 'google-preview form-control ' . ( $errors->has('password') ? ' is-invalid' : '' ),
                                                "placeholder" => "New password",
                                            ])
                                }}
                                @if($errors->has("password"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("password") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label("confirm-password", 'Confirm new password', ['class' => (empty($user)? 'required' : '').' control-label']) }}
                                {{ Form::password("confirm-password",
                                            [
                                                "class" => 'google-preview form-control ' . ( $errors->has('confirm-password') ? ' is-invalid' : '' ),
                                                "placeholder" => "Confirm new password",
                                            ])
                                }}
                                @if($errors->has("confirm-password"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("confirm-password") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('roles', 'Roles', ['class' => '']) }}
                                {{ Form::select('roles[]',$role,
                                    old("roles") ? old("roles") : (!empty($user) ? $role_ids = $user->roles->map(function($item)
                                                {
                                                    return $item->id;
                                                }) : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('roles') ? ' is-invalid' : '' ),
                                        "id" => "roles",
                                        "multiple" => "multiple"
                                    ])
                                }}
                                @if($errors->has("roles"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("roles") }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="col-12 col-md-12">
                    <div class="col text-center form-group">
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('js')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    var app = new Loader();
    $(function () {
        app.removeThumb();
        $('#roles, #job_id').select2();
    })
</script>
@stop
