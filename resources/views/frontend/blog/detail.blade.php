@extends('layouts.frontend')
@section('title', $postDetail->title)
@section('description', $postDetail->description)
@section('keywords', str_replace(' ', ' ,', $postDetail->title))
@section('img',url('/uploads/'.$postDetail->img))
@section('url', url('/'.$postDetail->slug))
@section('content')
<div class="breadcrumbs">
    <div>
        <div class="breadcrumb-content-inner">
            <div class="gva-breadcrumb-content">
                <div id="block-gavias-unix-breadcrumbs" class="text-light block gva-block-breadcrumb block-system block-system-breadcrumb-block no-title">
                    <div class="breadcrumb-style" style="background-image: url('/photos/1/background/breadcrumb.jpg');background-position: center center;background-repeat: repeat;">
                        <div class="container">
                            <div class="breadcrumb-content-main">
                                <h2 class="page-title"> {{ $postDetail->title }} </h2>
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> <a href="/category/{{ $postDetail->categories->first()->slug }}">{{ $postDetail->categories->first()->title }}</a> <span class=""></span> </li>
                                                </ol>
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
<div role="main" class="main main-page has-breadcrumb">
    <div class="content content-full">
        <div class="container container-bg">
            <div class="content-main-inner">
                <div class="row">
                    <div class="main-content col-xs-12 col-md-9 sb-r ">
                        <div class="main-content-inner">
                            <div class="content-main">
                                <div>
                                    <div id="block-gavias-unix-content" class="block block-system block-system-main-block no-title">
                                        <div class="content block-content">
                                            <article class="node node-detail node--type-article node--promoted node--view-mode-full clearfix">
                                                <div class="post-block">
                                                    <div class="post-content">
                                                        <h1 class="post-title"><span >{{ $postDetail->title }}</span></h1>
                                                        <div class="post-meta">
                                                            <span class="post-categories">
                                                                <a href="/category/{{ $postDetail->categories->first()->slug }}" >{{ $postDetail->categories->first()->title }}</a></span>
                                                                     /
                                                                <span class="post-created"> {{ $postDetail->created_at->format('d/m/Y') }} </span>
                                                                @can('article-create')
                                                                 / <span class="post-categories"> <a href="{{ route('post.edit', $postDetail->id) }}" target="_bank">Chỉnh sửa </a></span>
                                                                @endcan
                                                        </div>
                                                        <div class="node__content--detail clearfix">
                                                            {!! $postDetail->content !!}
                                                        </div>
                                                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="display: none">
                                                            <div class="column-inner  bg-size-cover  row">
                                                                <div class="column-content-inner">
                                                                    <div class="widget gsc-heading  align-center style-2 text-dark  wow fade-up animated"
                                                                        style="visibility: visible; animation-name: fadeInUp;">
                                                                        <h2 class="title"><span>Thông tin đơn hàng mới nhất</span></h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="widget block clearfix gsc-block-view  gsc-block-drupal block-view title-align-left  text-dark remove-margin-off wow fade-up animated"
                                                                            data-wow-delay="0.3s"
                                                                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                                                            <div class="views-element-container">
                                                                                <div>
                                                                                    <div class="view-content-wrap">
                                                                                        <table class="rwd-table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th>NGÀNH NGHỀ</th>
                                                                                                    <th>SỐ LƯỢNG</th>
                                                                                                    <th>NƠI LÀM VIỆC</th>
                                                                                                    <th>MỨC LƯƠNG/THÁNG</th>
                                                                                                    <th>ĐĂNG KÝ</th>
                                                                                                </tr>
                                                                                                @foreach ($topProduct as $item)
                                                                                                <tr>
                                                                                                    <td
                                                                                                        data-th="NGÀNH NGHỀ">
                                                                                                        <a
                                                                                                            href="/don-hang/{{ $item->slug }}"><strong>{{ $item->name }}</strong></a>
                                                                                                    </td>
                                                                                                    <td
                                                                                                        data-th="SỐ LƯỢNG">
                                                                                                        <span
                                                                                                            class="slot--table">
                                                                                                            {{ $item->slot }}
                                                                                                        </span>
                                                                                                    </td>
                                                                                                    <td
                                                                                                        data-th="NƠI LÀM VIỆC">
                                                                                                        <span
                                                                                                            class="slot--table">{{ $item->workplace }}</span>
                                                                                                    </td>
                                                                                                    <td
                                                                                                        data-th="MỨC LƯƠNG">
                                                                                                        <span style="white-space: nowrap;"
                                                                                                            class="salary--table">{{ product_price($item->price) }}</span>
                                                                                                    </td>
                                                                                                    <td
                                                                                                        data-th="NGÀY THI TUYỂN">
                                                                                                        <span style="display: none"
                                                                                                            class="slot--table">{{ date('d/m/Y', strtotime($item->date)) }}</span>
                                                                                                        <div
                                                                                                            class="enroll--table">
                                                                                                            <a class="btn-theme" href="/don-hang/{{ $item->slug }}" style="white-space: nowrap;">Đăng
                                                                                                                ký</a>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <section style="margin-top: 30px;">
                                                            <h2 class="block-title"><span>chia sẻ bài viết</span></h2>
                                                                <div class="share--social" data-url="{{ url('/'.$postDetail->slug) }}" data-img="{{ url('/uploads/'.$postDetail->img) }}" data-des="{{ $postDetail->description }}"></div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <section>
                                        <h3>Để lại bình luận</h3>
                                        <div id="fb-root"></div>
                                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0&appId=237162114026159&autoLogAppEvents=1" nonce="oEp950gE"></script>
                                        <div class="fb-comments" data-href="{{ url('/'.$postDetail->slug) }}" data-numposts="5" data-width="100%"></div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar sidebar-right theiaStickySidebar">
                        <div class="sidebar-inner">
                            <div>
                                @include('frontend.contacts.register_home')
                                <!--
                                    <div class="views-element-container block block-views block-views-blockpost-other-block-1">
                                    <h2 class="block-title"><span>Đăng ký tư vấn miễn phí</span></h2>
                                        <div class="content block-content">
                                            <div class="course-includes">
                                                <div class="content-inner">
                                                    <form onsubmit="showXModal('#myModal');" class="webform-submission-form" data-drupal-selector="webform-submission-register-course-node-1-add-form" action="{{ route('customer.post') }}" method="post" accept-charset="UTF-8">
                                                        @csrf
                                                        <div class="form-item form-no-label">
                                                            <input data-drupal-selector="edit-your-name" required="required" type="text" id="edit-your-name" name="full_name" value="{{ old("full_name") ? old("full_name") : '' }}" size="60" maxlength="255" placeholder="Họ và tên" class="form-text"> </div>
                                                            @if($errors->has("full_name"))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first("full_name") }}
                                                                </div>
                                                            @endif
                                                        <div class="form-item form-no-label">
                                                            <input data-inputmask-alias="datetime" required="required" data-inputmask-inputformat="dd/mm/yyyy" data-drupal-selector="edit-birthday" type="text" id="edit-birthday" name="birth_day" value="{{ old("birth_day") ? old("birth_day") : '' }}" size="60" maxlength="255" placeholder="Năm sinh" class="form-text init-inputmask"> </div>
                                                            @if($errors->has("birth_day"))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first("birth_day") }}
                                                                </div>
                                                            @endif
                                                        <div class="form-item form-no-label">
                                                            <select required="required" name="sex" data-drupal-selector="edit-sex" id="edit-sex" class="form-text">
                                                                <option value="" disabled selected>Chọn giới tính</option>
                                                                @foreach (config('custom.sex') as $key => $item)
                                                                <option value="{{ $key }}" {{ old("sex") ? (old("sex")==$key? 'selected':'') : '' }}> {{ $item }}
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-item form-no-label">
                                                            <input required="required" data-drupal-selector="edit-your-phone-number" type="text" id="edit-your-phone-number" name="phone" value="{{ old("phone") ? old("phone") : '' }}" size="60" maxlength="255" placeholder="Số điện thoại" class="form-text"> </div>
                                                            @if($errors->has("phone"))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first("phone") }}
                                                                </div>
                                                            @endif
                                                        <div class="form-item form-no-label">
                                                            <input data-drupal-selector="edit-address" type="text" id="edit-address" name="address" value="{{ old("address") ? old("address") : '' }}" size="60" maxlength="255" placeholder="Địa chỉ" class="form-text"> </div>
                                                            @if($errors->has("address"))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first("address") }}
                                                                </div>
                                                            @endif
                                                        <div class="form-group">

                                                            {!! NoCaptcha::renderJs() !!}
                                                            {!! NoCaptcha::display() !!}
                                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                        </div>
                                                        <div class="form-submit" style="display: inline-block; width: 100%">
                                                            <div id="html_captcha_element" ></div>

                                                        </div>
                                                        <div class="form-item form-no-label">
                                                            <div data-drupal-selector="edit-actions" class="form-actions form-wrapper" id="edit-actions">
                                                                <input class="webform-button--submit button button--primary form-submit" data-drupal-selector="edit-submit" type="submit" id="edit-submit" name="op" value="Đăng ký">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>

                                <div class="views-element-container block block-views block-views-blockpost-other-block-1">
                                    <h2 class="block-title"><span>Bài viết liên quan</span></h2>
                                    <div class="content block-content">
                                        <div>
                                            <div class="post-style-list small">
                                                <div class="item-list">
                                                    <ul>
                                                        @foreach ($related as $item)
                                                            <li class="view-list-item">
                                                                <div class="views-field views-field-nothing">
                                                                    <div class="field-content">
                                                                        <div class="post-block">
                                                                            <div class="post-image">
                                                                                <a href="/{{ $item->slug }}"><img src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('noimage') }}" alt="{{ $item->title }}"></a>
                                                                            </div>
                                                                            <div class="post-content">
                                                                                <div class="post-title"> <a href="/{{ $item->slug }}"> {{ $item->title }}</a> </div>
                                                                                <div class="post-meta"> <span class="post-created">{{ $item->created_at->format('d/m/Y') }} </span> </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="views-element-container block block-views block-views-blockcategories-post-block-1">
                                    <h2 class="block-title"><span>Thể loại</span></h2>
                                    <div class="content block-content">
                                        <div>
                                            <div class="category-list">
                                                <div class="item-list">
                                                    <ul>
                                                        @foreach ($category as $item)
                                                        <li class="view-list-item">
                                                            <div class="views-field views-field-name"><span class="field-content"><a href="/category/{{ $item->slug }}">{{ $item->title }}</a></span></div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($postDetail->tags->count() > 0)
                                    <div class="views-element-container block block-views block-views-blockcategories-post-block-2">
                                        <h2 class="block-title"><span>Từ khóa: </span></h2>
                                        <div class="content block-content">
                                            <div>
                                                <div class="tags-list">
                                                    <div class="item-list">
                                                        <ul>
                                                            @foreach ($postDetail->tags as $item)
                                                                <li class="view-list-item">
                                                                    <div class="views-field views-field-name"><span class="field-content"><a href="/tag/{{ $item->slug }}">{{ $item->title }}</a></span></div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nozomijapan thông báo</h4>
      </div>
      <div class="modal-body">
        Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ sớm liên hệ lại với bạn.
      </div>

    </div>
  </div>
</div>

@endsection
@push('css')
    <style type="text/css">
    .webform-submission-form .invalid-feedback {
        color: #e3342f;
        margin-top: -30px;
        font-size: 14px;
    }
    </style>
@endpush

@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {



        var app = new Loader();
	    app.require([
            "/vendor/jscocials/jssocials.min.js",
            "/vendor/jscocials/jssocials.css",
            "/vendor/jscocials/jssocials-theme-flat.css",
            "https://sp.zalo.me/plugins/sdk.js"],
		function() {
			// Callback
            app.shareSocialInit();
		});


    });
    function showXModal(e){
	 	   jQuery(e).modal('show');
	    }
</script>
@endpush

@push('schema')
{!! $postDetail->schema !!}
@endpush
