<?php 
//header('location:/'); exit;
?>
@extends('layouts.frontend')
@section('title', $product->name)
@section('description', $product->description)
@section('keywords', str_replace(' ', ' ,', $product->name))
@section('img',url('/uploads/'.$product->img))
@section('url', url('/don-hang/'.$product->slug))
@section('content')
<div id="content" class="content content-full">
    <div class="main-content-inner">
        <div class="content-main">
            <div>
                <div id="block-gavias-unix-content" class="block block-system block-system-main-block no-title">
                    <div class="content block-content">
                        <article>
                            <div class="single-course">
                                <div class="single-course-top">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 col-xs-12">
                                                <h1 class="post-title"> <div class="field field--name-title field--type-string field--label-hidden field__item">{{ $product->name }}</div> </h1>
                                                <div class="headline">
                                                    <div class="field field--name-field-course-headline field--type-text-long field--label-hidden field__item">
                                                        <p>{{ $product->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="what-learn hidden-xs">
                                                    <div class="field field--name-field-what-learn field--type-text-long field--label-above">
                                                        <div class="field__item">
                                                            <ul>
                                                                <li>Số lượng: {{ $product->slot }}</li>
                                                                <li>Nơi làm việc: {{ $product->workplace }}</li>
                                                                <li>Mức lương/tháng: <span class="salary">{{ product_price($product->price) }}</span></li>
                                                                <li>Ngày tuyển: {{ date('d/m/Y', strtotime($product->date)) }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12 col-md-push-8 course-right">
                                            <div class="image course-images lightGallery">
                                                <div>
                                                    <div class="image-item">
                                                        <a class="zoomGallery" title="" data-rel="lightGallery"> <span class="icon-expand"><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($product->date)) }} </span></a>
                                                        <div class="main-images"> <img src="{{ !is_null($product->img)? '/uploads/'.$product->img : \setting('noimage') }}" alt="" typeof="foaf:Image"> </div>
                                                    </div>
                                                </div>
                                                <a class="video-link popup-video"><i class="fa fa-user"></i> {{ $product->slot }}</a> </div>
                                            <div class="course-right-content clearfix remove_padding_bottom ">
                                                <div class="course-meta clearfix">
                                                    <div class="block-course-title">{{ $product->name }}</div>
                                                    <div class="meta-item">
                                                        <div class="content">
                                                            <div class="lab">Số lượng</div>
                                                            <div class="val">
                                                                <div class="field__items">
                                                                    <div class="field__item salary">{{ $product->slot }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="meta-item">
                                                        <div class="content">
                                                            <div class="lab">Mức lương/tháng</div>
                                                            <div class="val">
                                                                <div class="field__item salary">{{ product_price($product->price) }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="meta-item">
                                                        <div class="content">
                                                            <div class="lab">Ngày tuyển</div>
                                                            <div class="val">
                                                                <div class="field__item">{{ date('d/m/Y', strtotime($product->date)) }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="course-includes">
                                                    <div class="block-course-title">Đăng ký tư vấn miễn phí</div>
                                                    <div class="content-inner">
                                                        <form onsubmit="showModal('#myModal')" class="webform-submission-form" data-drupal-selector="webform-submission-register-course-node-1-add-form" action="{{ route('customer.addcart') }}" method="post" accept-charset="UTF-8">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <div class="form-item form-no-label">
                                                                <input data-drupal-selector="edit-your-name" type="text" id="edit-your-name" name="full_name" required="required" value="{{ old("full_name") ? old("full_name") : '' }}" size="60" maxlength="255" placeholder="Họ và tên" class="form-text"> </div>
                                                                @if($errors->has("full_name"))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first("full_name") }}
                                                                    </div>
                                                                @endif
                                                            <div class="form-item form-no-label">
                                                                <input data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" required="required" data-drupal-selector="edit-birthday" type="text" id="edit-birthday" name="birth_day" value="{{ old("birth_day") ? old("birth_day") : '' }}" size="60" maxlength="255" placeholder="Năm sinh" class="form-text init-inputmask"> </div>
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
                                                                <input data-drupal-selector="edit-your-phone-number" required="required" type="text" id="edit-your-phone-number" name="phone" value="{{ old("phone") ? old("phone") : '' }}" size="60" maxlength="255" placeholder="Số điện thoại" class="form-text"> </div>
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
                                                            <div data-drupal-selector="edit-actions" class="form-actions form-wrapper" id="edit-actions">
                                                                <input  class="webform-button--submit button button--primary form-submit" data-drupal-selector="edit-submit" type="submit" id="edit-submit" name="op" value="Đăng ký">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-xs-12 col-md-pull-4 course-left">
                                            <div class="course-content">
                                                <div class="post-content">
                                                    <div class="node__content clearfix">
                                                        <div class="field__item">
                                                            {!! $product->content !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="node-single-comment">
                                                <section>
                                                    <h2 class="block-title"><span>chia sẻ đơn hàng</span></h2>
                                                        <div class="share--social" data-url="{{ url('/'.$product->slug) }}" data-img="{{ url('/uploads/'.$product->img) }}" data-des="{{ $product->description }}"></div>
                                                </section>
                                            </div>
                                            <div id="node-single-comment">
                                                <section>
                                                    <h3>Để lại bình luận</h3>
                                                    <div id="fb-root"></div>
                                                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0&appId=237162114026159&autoLogAppEvents=1" nonce="oEp950gE"></script>
                                                    <div class="fb-comments" data-href="{{ url('/don-hang/'.$product->slug) }}" data-numposts="5" data-width="100%"></div>
                                                </section>
                                            </div>
                                            <div id="node-single-comment">
                                                <section>
                                                    <h2>Đơn hàng mới</h2>
                                                    <div class="block-content">
                                                        <div class="views-element-container">
                                                            <div class="js-view-dom-id">
                                                                <div class="gva-view-grid">
                                                                    <div class="gva-view-grid-inner lg-block-grid-2 md-block-grid-2 sm-block-grid-2 xs-block-grid-2">
                                                                        @foreach ($listProduct as $item)
                                                                            <div class="item-columns">
                                                                                <div>
                                                                                    <div class="course-block">
                                                                                        <div class="course-block-inner">
                                                                                            <div class="image lightGallery">
                                                                                                <div>
                                                                                                    <div class="image-item">
                                                                                                        <a href="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail') }}" class="zoomGallery" title="" data-rel="lightGallery">
                                                                                                            <span class="icon-expand"><i class="fa fa-calendar"></i>{{ date('d/m/Y', strtotime($item->date)) }}</span>
                                                                                                        </a>
                                                                                                        <div class="main-images">
                                                                                                            <a href="/don-hang/{{ $item->slug }}"><img src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail') }}" alt="" typeof="foaf:Image"></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <a class="video-link popup-video"><i class="fa fa-user"></i> {{ $item->slot }}</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="course-content" style="margin-top: 0;">
                                                                                                <div class="content-inner">
                                                                                                    <h4 class="title"><a href="/don-hang/{{ $item->slug }}" rel="bookmark">{{ $item->name }}</a></h4>

                                                                                                    <div class="teacher">
                                                                                                        <div class="field">
                                                                                                            <div class="field__item"><span class="title">Mức lương/tháng:</span> <span class="salary">{{ product_price($item->price) }}</span></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="teacher">
                                                                                                        <div class="field">
                                                                                                            <div class="field__item"><span class="title--all">Số lượng: <span class="slot">{{ $item->slot }}</span></span></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="teacher">
                                                                                                        <div class="field">
                                                                                                            <div class="field__item"><span class="title--all">Nơi làm việc: <span class="date">{{ $item->workplace }}</span></span></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="teacher">
                                                                                                        <div class="field">
                                                                                                            <div class="field__item"><span class="title--all">Ngày tuyển: <span class="date">{{ date('d/m/Y', strtotime($item->date)) }}</span></span></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="content-action"><a href="/don-hang/{{ $item->slug }}">Xem chi tiết</a></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="button-center"> <a href="/don-hang/" class="btn-theme">Xem thêm</a> </div>
                                                    </div>
                                                </section>
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

@push('scripts')
<script>
   jQuery(document).ready(function () {
	   
	var app = new Loader();
	app.require([
		"/vendor/input-mask/moment.min.js",
        "/vendor/input-mask/jquery.inputmask.bundle.min.js",
        "/vendor/jscocials/jssocials.min.js",
        "/vendor/jscocials/jssocials.css",
        "/vendor/jscocials/jssocials-theme-flat.css",
        "https://sp.zalo.me/plugins/sdk.js"],
		function() {
			// Callback
            app.validateDate();
            app.shareSocialInit();
		});
    });

   function showModal(e){
	   jQuery(e).modal('show');
   }
</script>
@endpush

@push('schema')
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "WebSite",
      "name": "Nozomi Japan",
      "url": "https://nozomijapan.vn",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://nozomijapan.vn/search/?s={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Đơn hàng đi Nhật",
        "item": "https://nozomijapan.vn/don-hang"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "{{ $product->name }}",
        "item": "{{ url('don-hang')}}/{{ $product->slug }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "Đơn hàng chế biến thực phẩm y tế tại Nhật Bản",
      "image": "{{ url('uploads')}}/{{ $product->img }}",
      "description": "{{ $product->description }}
      Số lượng: {{ $product->slot }}
      Nơi làm việc: {{ $product->workplace }}
      Mức lương/tháng: {{ product_price($product->price) }}
      Ngày tuyển: {{ date('d/m/Y', strtotime($product->date)) }}",
      "brand": "Nozomi Japan",
      "sku": "tpyt",
      "mpn": "tpyt",
      "offers": {
        "@type": "Offer",
        "url": "{{ url('don-hang')}}/{{ $product->slug }}",
        "priceCurrency": "VND",
        "price": "{{ $product->price }}"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "bestRating": "5",
        "worstRating": "5",
        "ratingCount": "1",
        "reviewCount": "1"
      },
      "review": {
        "@type": "Review",
        "name": "đánh giá {{ $product->name }}",
        "reviewBody": "Bay nhanh",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "5",
          "bestRating": "5",
          "worstRating": "5"
        },
        "datePublished": "{{ $product->created_at->format('d/m/Y') }}",
        "author": {"@type": "Person", "name": "oanh"},
        "publisher": {"@type": "Organization", "name": "nozomi japan"}
      }
    }
    </script>
@endpush
