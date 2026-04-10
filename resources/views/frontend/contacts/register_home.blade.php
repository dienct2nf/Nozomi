<?php
/**
 * @link https://framework.iziweb.net
 * @copyright Copyright (c) 2021 Izi Software LLC
 * @license https://framework.iziweb.net/license
 * @author Giang A Tin <vantruong1898@gmail.com>
 * @since 2.0
 * @ide PhpStorm 2021
 * @workplace Home Office
 */
?>

<div class="column-content-inner">
            <div class="widget gsc-heading align-left style-1 text-dark wow fade-up animated">
                <h2 class="title home-title_v1"><span class="green">{{ setting('section3_form_label') }}</span></h2> </div>
            <div class="clearfix"></div>
            <div class=" clearfix widget gsc-block-drupal title-align-left hidden-title-on remove-margin-on text-dark wow fade-up animated" data-wow-delay="0.2s">
                <div class="block block-webform block-webform-block no-title">
                    <div class="content block-content">
                        <form class="webform-submission-form contactForm" data-drupal-selector="webform-submission-register-course-node-1-add-form" action="{{ route('customer.post') }}" method="post" accept-charset="UTF-8">
                            @csrf
                            <div class="form-item form-no-label">
                                <input data-drupal-selector="edit-your-name" type="text" id="edit-your-name" name="full_name" value="" size="60" maxlength="255" placeholder="Họ và tên" class="form-text required">
                                @if($errors->has("full_name"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("full_name") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-item form-no-label">
                                <input data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-drupal-selector="edit-birthday" type="text" id="edit-birthday" name="birth_day" value="" size="60" maxlength="255" placeholder="Năm sinh" class="form-text init-inputmask required">
                                @if($errors->has("birth_day"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("birth_day") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-item form-no-label">
                                <select name="sex" data-drupal-selector="edit-sex" id="edit-sex" class="form-text required">
                                    <!--<option value="" disabled selected>Chọn giới tính</option>-->
                                    @foreach (config('custom.sex') as $key => $item)
                                        <option value="{{ $key }}"> {{ $item }}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-item form-no-label">
                                <input data-drupal-selector="edit-your-phone-number" type="text" id="edit-your-phone-number" name="phone" value="" size="60" maxlength="255" placeholder="Số điện thoại" class="form-text required">
                                @if($errors->has("phone"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("phone") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-item form-no-label">
                                <input data-drupal-selector="edit-address" type="text" id="edit-address" name="address" value="" size="60" maxlength="255" placeholder="Địa chỉ" class="form-text required">
                                @if($errors->has("address"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("address") }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">

                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            </div>
                            <div class="form-submit" style="display: inline-block; width: 100%">
                                <div id="html_captcha_element" ></div>

                            </div>
                            <div data-drupal-selector="edit-actions" class="form-actions form-wrapper" id="edit-actions">
                                <input class="webform-button--submit button button--primary form-submit" data-drupal-selector="edit-submit" type="submit" id="edit-submit" name="op" value="{{ setting('section3_form_btn_label') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


@push('scripts')

    <script>
        jQuery(document).ready(function() {
            var form = jQuery("#contactForm, .contactForm");
            form.on("submit", function (event) {

                if (event.isDefaultPrevented()) {
                    // handle the invalid form...
                    formError();
                    /* submitMSG(false, "Did you fill in the form properly?");*/
                } else {
                    // everything looks good!
                    event.preventDefault();
                    submitForm(form);
                }
            });

        });

    </script>
@endpush
