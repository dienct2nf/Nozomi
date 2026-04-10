@extends('layouts.frontend')
@section('title', 'Liên hệ - '.\setting('title'))
@section('description', \setting('description'))
@section('keywords', \setting('keywords'))
@section('img', url('/').\setting('thumbnail'))
@section('url', url('/'))
@section('content')
<div class="breadcrumbs">
    <div>
        <div class="breadcrumb-content-inner">
            <div class="gva-breadcrumb-content">
                <div id="block-gavias-unix-breadcrumbs" class="text-light block gva-block-breadcrumb block-system block-system-breadcrumb-block no-title">
                    <div class="breadcrumb-style" style="background-image: url('/photos/1/background/breadcrumb.jpg');background-position: center center;background-repeat: repeat;">
                        <div class="container">
                            <div class="breadcrumb-content-main">
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <h2 id="system-breadcrumb" class="visually-hidden">Đăng ký thành công</h2>

                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($message = Session::get('status'))
    <div class="node__content clearfix">
        <div class="field field--name-field-content-builder field--type-gavias-content-builder field--label-hidden field__item">
            <div class="gavias-blockbuilder-content">
                <div class="gavias-builder--content">
                    <div class="gbb-row-wrapper">
                        <div class=" gbb-row bg-size-cover " style="">
                            <div class="bb-container container">
                                <div class="row">
                                    <div class="row-wrapper clearfix">
                                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="column-inner bg-size-cover ">
                                                <div class="column-content-inner">
                                                    <div class="widget gsc-heading align-center style-1 text-dark wow fade-up">
                                                        <h2 class="title">
                                                            <span>Cảm ơn!</span>
                                                        </h2>
                                                        <div class="title-desc">
                                                            <p> {{ $message }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div role="main" class="main main-page has-breadcrumb">
	<div class="clearfix"></div>
	<div id="content" class="content content-full">
		<div class="container-full container-bg">
			<div class="content-main-inner">
				<div class="main-content">
					<div class="main-content-inner">
						<div class="content-main">
							<div>
								<div class="block block-system block-system-main-block no-title">
									<div class="content block-content">
										<article class="node node--type-page node--view-mode-full">
											<div class="node__content clearfix">
												<div class="field field--name-field-content-builder field--type-gavias-content-builder field--label-hidden field__item">
													<div class="gavias-blockbuilder-content">
														<div class="gavias-builder--content">
                                                            <div class="gbb-row-wrapper">
                                                                <div class=" gbb-row bg-size-cover " style="">
                                                                    <div class="bb-inner ">
                                                                        <div class="bb-container container">
                                                                            <div class="row">
                                                                                <div class="row-wrapper clearfix">
                                                                                    <div class="gsc-column col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                                                                        <div class="column-inner bg-size-cover ">
                                                                                            <div class="column-content-inner">
                                                                                                <div class="widget gsc-heading align-left style-2 text-dark ">
                                                                                                    <h2 class="title">
                                                                                                        <span>Bản đồ</span>
                                                                                                    </h2>
                                                                                                </div>
                                                                                                {!! \setting('iframe') !!}
                                                                                                <div class="widget gsc-socials style-2">
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-facebook"></i>
                                                                                                    </a>
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-skype"></i>
                                                                                                    </a>
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-twitter"></i>
                                                                                                    </a>
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-pinterest-p "></i>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="column-content ">
                                                                                                    <p>{{ \setting('description') }}</p>
                                                                                                    <ul class="contact-info">
                                                                                                        <li><span><i class="fa fa-home"></i> {{ \setting('location_hanoi') }}</span></li>
                                                                                                        <li><span><i class="fa fa fa-map-marker"></i> {{ \setting('location_tphcm') }}</span></li>
                                                                                                        <li><span><i class="fa fa fa-map-marker"></i> {{ \setting('location_japan') }} </span></li>
                                                                                                        <li><span><i class="fa fa-mobile-phone"></i> <a href="tel:{{ \setting('phone') }}">{{ \setting('phone') }}</a></span></li>
                                                                                                        <li><a href="mailto:{{ \setting('email') }}"><i class="fa fa-envelope-o"></i> {{ \setting('email') }}</a></li>
                                                                                                        {{-- <li><span><i class="fa fa-skype"></i> {{ \setting('skype') }}</span> </li> --}}
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gsc-column col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                                                                        <div class="column-inner bg-size-cover ">
                                                                                            <div class="column-content-inner">
                                                                                                <div class="widget gsc-heading align-left style-2 text-dark ">
                                                                                                    <h2 class="title">
                                                                                                        <span>Liên hệ</span>
                                                                                                    </h2>
                                                                                                </div>
                                                                                                <div class="clearfix"></div>
                                                                                                <div class=" clearfix widget gsc-block-drupal title-align-left hidden-title-on remove-margin-on text-dark">
                                                                                                    <div id="block-gavias-unix-webform" class="block block-webform block-webform-block no-title">
                                                                                                        <div class="content block-content">
                                                                                                            <form class="webform-submission-form webform-submission-contact-form" action="{{ route('customer.contact') }}" method="post" accept-charset="UTF-8">
                                                                                                                @csrf
                                                                                                                <div class="js-form-item form-item js-form-type-textfield form-item-name js-form-item-name">
                                                                                                                    <label for="edit-name" class="js-form-required form-required">Họ và tên</label>
                                                                                                                    <input data-drupal-selector="edit-name" type="text" id="edit-name" name="full_name" value="{{ old("full_name") ? old("full_name") : '' }}" size="60" maxlength="255" class="form-text required">
                                                                                                                    @if($errors->has("full_name"))
                                                                                                                        <div class="invalid-feedback">
                                                                                                                            {{ $errors->first("full_name") }}
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="js-form-item form-item js-form-type-textfield form-item-subject js-form-item-subject">
                                                                                                                    <label for="edit-sex" class="visually-hidden">Giới tính</label>
                                                                                                                    <select name="sex" data-drupal-selector="edit-sex" id="edit-sex" class="form-text">
                                                                                                                        @foreach (config('custom.sex') as $key => $item)
                                                                                                                            <option value="{{ $key }}" {{ old("sex") ? (old("sex")==$key? 'selected':'') : '' }}> {{ $item }}
                                                                                                                        @endforeach
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="js-form-item form-item js-form-type-email form-item-email js-form-item-email">
                                                                                                                    <label for="edit-email" class="js-form-required form-required">Email</label>
                                                                                                                    <input data-drupal-selector="edit-email" type="email" id="edit-email" name="email" value="{{ old("email") ? old("email") : '' }}" size="60" maxlength="254" class="form-email required">
                                                                                                                    @if($errors->has("email"))
                                                                                                                        <div class="invalid-feedback">
                                                                                                                            {{ $errors->first("email") }}
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="js-form-item form-item js-form-type-textfield form-item-subject js-form-item-subject">
                                                                                                                    <label for="edit-phone" class="js-form-required form-required">Điện thoại</label>
                                                                                                                    <input data-drupal-selector="edit-phone" type="text" id="edit-phone" name="phone" value="{{ old("phone") ? old("phone") : '' }}" size="60" maxlength="255" class="form-text required">
                                                                                                                    @if($errors->has("phone"))
                                                                                                                        <div class="invalid-feedback">
                                                                                                                            {{ $errors->first("phone") }}
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="js-form-item form-item js-form-type-textfield form-item-subject js-form-item-subject">
                                                                                                                    <label for="edit-address" class="js-form-required form-required">Địa chỉ</label>
                                                                                                                    <input data-drupal-selector="edit-address" type="text" id="edit-address" name="address" value="{{ old("address") ? old("address") : '' }}" size="60" maxlength="255" class="form-text required">
                                                                                                                    @if($errors->has("address"))
                                                                                                                        <div class="invalid-feedback">
                                                                                                                            {{ $errors->first("address") }}
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="js-form-item form-item js-form-type-textarea form-item-message js-form-item-message">
                                                                                                                    <label for="edit-other_details" class="js-form-required form-required">Nội dung</label>
                                                                                                                    <div>
                                                                                                                        <textarea data-drupal-selector="edit-other_details" id="edit-other_details" name="other_details" rows="5" cols="60" class="form-textarea required">{{ old("other_details") ? old("other_details") : '' }}</textarea>
                                                                                                                        @if($errors->has("other_details"))
                                                                                                                            <div class="invalid-feedback">
                                                                                                                                {{ $errors->first("other_details") }}
                                                                                                                            </div>
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div data-drupal-selector="edit-actions" class="form-actions webform-actions js-form-wrapper form-wrapper" id="edit-actions">
                                                                                                                    <input class="webform-button--submit button button--primary js-form-submit form-submit" data-drupal-selector="edit-actions-submit" type="submit" id="edit-actions-submit" name="op" value="Gửi">
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   jQuery(document).ready(function () {
	var app = new Loader();
	app.require([
		"/vendor/input-mask/moment.min.js",
		"/vendor/input-mask/jquery.inputmask.bundle.min.js"],
		function() {
			// Callback
			app.validateDate();
		});
    });
</script>
@endpush
