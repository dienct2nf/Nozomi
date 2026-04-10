{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', $text)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $text }}</li>
        </ol>
    </nav>
@stop
@php
Auth::user()->unreadNotifications()->update(['read_at' => now()]);
@endphp
@section('content')
@if ($message = Session::get('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    @if (empty($customer))
        {!! Form::open(['route' => 'customer.store', 'files' => true]) !!}
    @else
        {!! Form::model($customer, ['route' => ['customer.update', $customer->id], 'files' => true]) !!}
        {{ method_field('PUT') }}
    @endif
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin</h4>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-md-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {{ Form::label("full_name", 'Họ và tên', ['class' => 'required control-label']) }}
                                    {{ Form::text("full_name",
                                                old("full_name") ? old("full_name") : (!empty($customer) ? $customer->full_name : null),
                                                [
                                                    "class" => 'form-control ' . ( $errors->has('full_name') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Họ và tên",
                                                ])
                                    }}
                                    @if($errors->has("full_name"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("full_name") }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label("phone", 'Điện thoại', ['class' => 'control-label']) }}
                                    {{ Form::text("phone",
                                                old("phone") ? old("phone") : (!empty($customer) ? $customer->phone : null),
                                                [
                                                    "class" => 'form-control ' . ( $errors->has('phone') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Điện thoại",
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
                                                old("address") ? old("address") : (!empty($customer) ? $customer->address : null),
                                                [
                                                    "class" => 'form-control ' . ( $errors->has('address') ? ' is-invalid' : '' ),
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
                                    {{ Form::label("birth_day", 'Ngày sinh', ['class' => 'required control-label']) }}
                                    {{ Form::text("birth_day",
                                                old("birth_day") ? old("birth_day") : (!empty($customer) ? date('d/m/Y', strtotime($customer->birth_day)) : null),
                                                [
                                                    "class" => 'form-control ' . ( $errors->has('birth_day') ? ' is-invalid' : '' ),
                                                    "placeholder" => "Ngày sinh",
                                                    "data-inputmask-alias" => "datetime",
                                                    "data-inputmask-inputformat" => "dd/mm/yyyy",
                                                    "data-mask" => "",
                                                ])
                                    }}
                                    @if($errors->has("birth_day"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("birth_day") }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label("email", 'Email', ['class' => 'required control-label']) }}
                                    {{ Form::text("email",
                                                old("email") ? old("email") : (!empty($customer) ? $customer->email : null),
                                                [
                                                    "class" => 'form-control ' . ( $errors->has('email') ? ' is-invalid' : '' ),
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
                                    {{ Form::label("sex", 'Giới tính', ['class' => 'control-label']) }}
                                    {{ Form::select('sex',config('custom.sex'),
                                        config('custom.sex')[is_null($customer->sex)? 'other': $customer->sex],
                                        [
                                            "class" => "form-control",
                                            "id" => "sex",
                                        ])
                                    }}
                                    @if($errors->has("sex"))
                                        <div class="invalid-feedback">
                                            {{ $errors->first("sex") }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (trim($customer->other_details) !== '')
                        <div class="form-group">
                            {{ Form::label("other_details", 'Câu hỏi', ['class' => 'control-label']) }}
                            {{ Form::textarea("other_details",
                                        old("other_details") ? old("other_details") : (!empty($customer) ? $customer->other_details : null),
                                        [
                                            "class" => 'form-control ' . ( $errors->has('other_details') ? ' is-invalid' : '' ),
                                            "rows" => "5",
                                            "placeholder" => "Câu hỏi",
                                        ])
                            }}
                            @if($errors->has("other_details"))
                                <div class="invalid-feedback">
                                    {{ $errors->first("other_details") }}
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Đơn Hàng</h4>
                </div>
                    <div class="card-body row">
                        @if (empty($customer->order->first()))
                            <p class="card-text" style="color: red">Khách hàng này chưa chọn đơn hàng.</p>
                        @endif
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('product_id', 'Đơn hàng', ['class' => '']) }}
                                {{ Form::select('product_id', $product,
                                    old("product_id") ? old("product_id") : (!empty($customer->order->first()) ? $customer->order->first()->products->first()->id : null),
                                    [
                                        "class" => 'form-control ' . ( $errors->has('product_id') ? ' is-invalid' : '' ),
                                        "id" => "product_id"
                                    ])
                                }}
                                @if($errors->has("product_id"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("product_id") }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {{ Form::label("status", 'Trạng thái', ['class' => 'control-label']) }}
                                {{ Form::select('status',config('custom.status_order'),
                                    (!empty($customer->order->first()) ? $customer->order->first()->status : null),
                                    [
                                        "class" => "form-control",
                                        "id" => "status",
                                    ])
                                }}
                                @if($errors->has("status"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("status") }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="col-12 col-md-12">
                    <div class="col text-center form-group">
                        {{ Form::submit('Lưu lại', ['class' => 'btn btn-primary']) }}
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
<!-- InputMask -->
<script src="/vendor/input-mask/moment.min.js"></script>
<script src="/vendor/input-mask/jquery.inputmask.bundle.min.js"></script>
<script>
    var app = new Loader();
    $(function () {
        $('#birth_day').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        app.removeThumb();
        $('#product_id, #status').select2();
    })
</script>
@stop
