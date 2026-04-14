@extends('layouts.frontend')
@section('title', \setting('title'))
@section('description', \setting('description'))
@section('keywords', \setting('keywords'))
@section('img', url('/').\setting('thumbnail'))
@section('url', url('/'))
@section('content')
<div class="gbb-row-wrapper">
    <div class=" gbb-row bg-size-default " style="background-color:#F8F8F8">
        <div class="bb-inner remove_padding">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div>
                                        <div class="widget block clearfix gsc-block-view gsc-block-drupal block-view title-align-left text-dark remove-margin-off">
                                            <div class="views-element-container">
                                                <div class="">
                                                    <div class="no-padding owl-carousel init-carousel-owl owl-loaded owl-drag"
                                                        data-items="1"
                                                        data-items_lg="1"
                                                        data-items_md="1"
                                                        data-items_sm="1"
                                                        data-items_xs="1"
                                                        data-loop="0"
                                                        data-speed="3000"
                                                        data-auto_play="1"
                                                        data-auto_play_speed="2000"
                                                        data-auto_play_timeout="3000"
                                                        data-auto_play_hover="1"
                                                        data-navigation="1"
                                                        data-rewind_nav="1"
                                                        data-pagination="0"
                                                        data-mouse_drag="0"
                                                        data-touch_drag="0">
                                                        @foreach (\sliders(\setting('slider')) as $item)
                                                            @if ($loop->first)
                                                                <div class="item">
                                                                    <img src="/uploads/{{ $item->img }}" alt="{{ $item->title }}">
                                                                </div>
                                                            @else
                                                                <div class="item">
                                                                    <img class="lozad" src="/uploads/{{ $item->img }}" alt="{{ $item->title }}">
                                                                </div>
                                                            @endif

                                                        @endforeach
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

<div class="gbb-row-wrapper">
    <div class="gbb-row bg-size-cover " style="">
        <div class="bb-inner default">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="widget gsc-heading align-center style-2 text-dark wow fade-up">

                            <h2 class="title"><span><span class="text-theme home-title">{{ setting('section1_title') }}<br/>{{ setting('section1_desc') }}</span></span></h2>
                            <div class="title-icon"><span><i class="fa fa-heartbeat"></i></span></div>
                        </div>

                        <div class="gsc-column col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="clearfix"></div>
                                    <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="row">
                                            <div class="column-inner bg-size-cover ">
                                                <div class="column-content-inner">
                                                    <div>
                                                        <div class="widget block clearfix gsc-block-view gsc-block-drupal block-view title-align-left text-dark remove-margin-off">
                                                            <div class="views-element-container wow fade-up animated">
                                                                <div class="">
                                                                    <div class="no-padding owl-carousel init-carousel-owl owl-loaded owl-drag"
                                                                         data-items="1"
                                                                         data-items_lg="1"
                                                                         data-items_md="1"
                                                                         data-items_sm="1"
                                                                         data-items_xs="1"
                                                                         data-loop="0"
                                                                         data-speed="2000"
                                                                         data-auto_play="1"
                                                                         data-auto_play_speed="1000"
                                                                         data-auto_play_timeout="4000"
                                                                         data-auto_play_hover="1"
                                                                         data-navigation="0"
                                                                         data-rewind_nav="1"
                                                                         data-pagination="0"
                                                                         data-mouse_drag="0"
                                                                         data-touch_drag="0">
                                                                        @foreach ($album as $item)
                                                                            <div class="item">
                                                                                <div>
                                                                                    <div class="gallery-block">
                                                                                        <div class="gallery-images lightGallery">
                                                                                            <div>
                                                                                                @php  ($data = $item->loadMedia(['original']) )
                                                                                                @php  ($i = 1 )
                                                                                                @foreach ($data->media as $row)
                                                                                                    <div class="image-item">
                                                                                                        <a href="/uploads/{{  $row->getDiskPath() }}" class="zoomGallery {{$i !== 1? 'hidden': '' }}" title="" data-rel="lightGallery">
                                                                                                            {!! $i == 1? '<span class="icon-expand"><i class="fa fa-expand"></i>': '' !!} <img class="lozad hidden" data-src="/uploads/{{  $row->getDiskPath() }}" alt="{{ $item->title }}"> </a>
                                                                                                        @if ($i == 1)
                                                                                                            <img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('noimage') }}" alt="{{ $item->title }}" typeof="foaf:Image">
                                                                                                        @else

                                                                                                        @endif
                                                                                                    </div>
                                                                                                    @php ($i++)
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="gallery-content">
                                                                                            <h3 class="post-title"><a href="/album/{{ $item->slug }}" rel="bookmark"><span>{{ $item->name }}</span></a></h3> </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
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
                        <div class="gsc-column col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="clearfix"></div>
                                    <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="row">
                                            <div class="column-inner bg-size-cover ">
                                                <div class="column-content-inner">
                                                    @foreach (\sliders(\setting('video_featured')) as $item)
                                                        <div class="widget gsc-video-box wow fade-up clearfix style-1 wow fade-up animated" data-wow-delay="0.2s">
                                                            <div class="video-inner">
                                                                <div class="image text-center"> <img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail')  }}" alt="{{ $item->title }}">
                                                                    <a class="popup-video gsc-video-link" href="{{ $item->link }}"><span class="icon"><i class="fa fa-play"></i></span></a> </div>
                                                            </div>
                                                            <div class="video-content">
                                                                <div class="video-content-background"></div>
                                                                <div class="left">
                                                                    <div class="video-title">{{ $item->description }}</div>
                                                                    <div class="video-desc">{{ $item->title }}</div>
                                                                </div>
                                                                <div class="right">
                                                                    <a class="popup-video gsc-video-link" href="{{ $item->link }}"> <i class="fa fa-play"></i> </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
<?php
@include('frontend.partials.home.section2')
?>
<?php
@include('frontend.partials.home.section3')
?>
<?php
@include('frontend.partials.home.section4')
?>
<?php
@include('frontend.partials.home.section5')
?>
<?php
@include('frontend.partials.home.section6')
?>

<div class="gbb-row-wrapper hide">
    <div class=" gbb-row bg-size-cover " style="background-color:#F8F8F8">
        <div class="bb-inner remove_padding_bottom default">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="widget gsc-heading align-center style-2 text-dark wow fade-up animated">
                                        <h2 class="title home-title_v1"><span class="green">Đơn hàng Thực Phẩm lớn nhất Miền Bắc</span></h2>
                                        <div class="title-icon"><span><i class="fa fa-snowflake-o"></i></span></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="gsc-tab-views block widget gsc-tabs-views-ajax style-1 wow fade-up animated" style="visibility: visible; animation-name: fadeInUp;">
                                        <div class="block-content">
                                            <div class="tabs-container clearfix">
                                                <div class="tab-content tab-content-view">
                                                    <div class="tab-pane clearfix fade in active">
                                                        <div class="block-content">
                                                            <div class="views-element-container">
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
                                                                                        <th>NGÀY THI TUYỂN
                                                                                        </th>
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
                                                                                            <span
                                                                                                class="salary--table">{{ product_price($item->price) }}</span>
                                                                                        </td>
                                                                                        <td
                                                                                            data-th="NGÀY THI TUYỂN">
                                                                                            <span
                                                                                                class="slot--table">{{ date('d/m/Y', strtotime($item->date)) }}</span>
                                                                                            <div
                                                                                                class="enroll--table">
                                                                                                <a href="/don-hang/{{ $item->slug }}" class="btn-theme">Đăng
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
                                                            <div class="button-center"> <a href="{{ url('don-hang') }}" class="btn-theme">Xem thêm đơn hàng</a> </div>
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

<div class="gbb-row-wrapper">
    <div class=" gbb-row bg-size-default " style="background-image:url('/photos/1/background/bg-new2.jpg'); background-repeat:no-repeat; background-position:center top">
        <div class="bb-inner default">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="widget gsc-heading align-center style-2 text-light ">
                                        <h2 class="title home-title_v1"><span class="white">{{ setting('section2_title') }}</span></h2>
                                        <div class="title-desc">
                                            <p>{{ setting('section2_desc') }}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="gsc-column col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="gsc-accordion" data-wow-delay="0.2s">
                                        <div class="views-element-container">
                                            <div class="post-list-small js-view-dom-id">
                                                <div class="item-list">
                                                    <ul>
                                                        @foreach ($listPostCamNang->posts as $item)
                                                            <li class="view-list-item">
                                                                <div class="views-field views-field-nothing">
                                                                    <div class="field-content">
                                                                        <div class="post-block">
                                                                            <div class="post-image">
                                                                                <a href="/{{ $item->slug }}"><img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail') }}" alt="{{ $item->title }}" typeof="Image"></a>
                                                                            </div>
                                                                            <div class="post-content">
                                                                                <div class="post-title"> <a href="/{{ $item->slug }}" hreflang="en">{{ $item->title }}</a> </div>
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
                            </div>
                        </div>
                        <div class="gsc-column col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    @foreach (\sliders(\setting('video')) as $item)
                                        <div class="widget gsc-video-box width-400 wow fade-up clearfix style-1" data-wow-delay="0.2s">
                                            <div class="video-inner">
                                                <div class="image text-center"> <img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail')  }}" alt="{{ $item->title }}">
                                                    <a class="popup-video gsc-video-link" href="{{ $item->link }}"><span class="icon"><i class="fa fa-play"></i></span></a> </div>
                                            </div>
                                            <div class="video-content">
                                                <div class="video-content-background"></div>
                                                <div class="left">
                                                    <div class="video-title">Nozomi</div>
                                                    <div class="video-desc">{{ $item->title }}</div>
                                                </div>
                                                <div class="right">
                                                    <a class="popup-video gsc-video-link" href="{{ $item->link }}"> <i class="fa fa-play"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="gsc-column col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div>
                                        <div class="widget block clearfix gsc-block-view gsc-block-drupal block-view title-align-left text-dark remove-margin-off wow fade-up" data-wow-delay="0.3s">
                                            <div class="views-element-container">
                                                <div class="post-list-small js-view-dom-id">
                                                    <div class="item-list">
                                                        <ul>
                                                            @foreach ($listPostTinTuc->posts as $item)
                                                                <li class="view-list-item">
                                                                    <div class="views-field views-field-nothing">
                                                                        <div class="field-content">
                                                                            <div class="post-block">
                                                                                <div class="post-image">
                                                                                    <a href="/{{ $item->slug }}"><img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail') }}" alt="{{ $item->title }}" typeof="Image"></a>
                                                                                </div>
                                                                                <div class="post-content">
                                                                                    <div class="post-title"> <a href="/{{ $item->slug }}" hreflang="en">{{ $item->title }}</a> </div>
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
                                        <div class="button-center"> <a href="{{ url('tin-tuc') }}" class="btn-theme">Xem thêm</a> </div>
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
<div class="gbb-row-wrapper">
    <div id="join" class=" gbb-row gva-parallax-background bg-size-cover " style="background-image:url('/photos/1/background/we-chose.jpg'); background-repeat:no-repeat; background-position:center">
        <div class="bb-inner default">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="gsc-column col-lg-4 col-md-4 col-sm-5 col-xs-12 ">
                            <div class="column-inner bg-size-cover columns-box-shadow ">
                                @include('frontend.contacts.register_home')
                            </div>
                        </div>
                        <div class="gsc-column col-lg-8 col-md-8 col-sm-7 col-xs-12 ">
                            <div class="column-inner bg-size-default ">
                                <div class="column-content-inner">
                                    <div class="widget gsc-heading align-left style-1 text-light wow fade-up animated">
                                        <h2 class="title home-title_v1"><span class="white">{{ setting('section3_title') }}</span></h2>
                                        <div class="title-desc">
                                            <p>{{ setting('section3_desc') }}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="gbb-row-wrapper">
                                        <div class=" gbb-row bg-size-cover " style="padding-top:20px">
                                            <div class="bb-inner default">
                                                <div class="bb-container container">
                                                    <div class="row">
                                                        <div class="row-wrapper clearfix">
                                                            <div class="gsc-column col-lg-4 col-md-4">
                                                                <div class="column-inner bg-size-cover ">
                                                                    <div class="column-content-inner">
                                                                        <div class="widget milestone-block position-icon-left text-light wow fade-up animated">
                                                                            <div class="milestone-icon"><span class="fa fa-clipboard"></span></div>
                                                                            <div class="milestone-right">
                                                                                <div class="milestone-number-inner"><span class="milestone-number">{{ setting('info_product') }}</span><span class="symbol">+</span></div>
                                                                                <div class="milestone-text">{{ setting('text_product') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-inner bg-size-cover ">
                                                                    <div class="column-content-inner">
                                                                        <div class="widget milestone-block position-icon-left text-light wow fade-up animated">
                                                                            <div class="milestone-icon"><span class="fa fa-plane"></span></div>
                                                                            <div class="milestone-right">
                                                                                <div class="milestone-number-inner"><span class="milestone-number">{{ setting('info_fly') }}</span><span class="symbol">+</span></div>
                                                                                <div class="milestone-text">{{ setting('text_fly') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-inner bg-size-cover ">
                                                                    <div class="column-content-inner">
                                                                        <div class="widget milestone-block position-icon-left text-light wow fade-up animated">
                                                                            <div class="milestone-icon"><span class="fa fa-thumbs-o-up"></span></div>
                                                                            <div class="milestone-right">
                                                                                <div class="milestone-number-inner"><span class="milestone-number">{{ setting('info_like') }}</span><span class="symbol">+</span></div>
                                                                                <div class="milestone-text">{{ setting('text_like') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-inner bg-size-cover ">
                                                                    <div class="column-content-inner">
                                                                        <div class="widget milestone-block position-icon-left text-light wow fade-up animated">
                                                                            <div class="milestone-icon"><span class="fa fa-heart"></span></div>
                                                                            <div class="milestone-right">
                                                                                <div class="milestone-number-inner"><span class="milestone-number">{{ setting('info_comment') }}</span><span class="symbol">+</span></div>
                                                                                <div class="milestone-text">{{ setting('text_comment') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="gsc-column col-lg-8 col-md-8">
                                                                <div class="column-inner bg-size-cover ">
                                                                    <div class="column-content-inner">
                                                                        <div class="gsc-accordion wow fade-up animated" data-wow-delay="0.2s">
                                                                            <div class="owl-carousel init-carousel-owl owl-loaded owl-drag testimonial-carousel"
                                                                                    data-items="1"
                                                                                    data-items_lg="1"
                                                                                    data-items_md="1"
                                                                                    data-items_sm="1"
                                                                                    data-items_xs="1"
                                                                                    data-loop="0"
                                                                                    data-speed="800"
                                                                                    data-auto_play="1"
                                                                                    data-auto_play_speed="1000"
                                                                                    data-auto_play_timeout="3000"
                                                                                    data-auto_play_hover="1"
                                                                                    data-navigation="1"
                                                                                    data-rewind_nav="0"
                                                                                    data-pagination="0"
                                                                                    data-mouse_drag="1"
                                                                                    data-touch_drag="1">
                                                                                @foreach (\sliders(\setting('review')) as $item)
                                                                                    <div class="item">
                                                                                        <div class="single-testimonial">
                                                                                            <div class="testimonials-wrapper">
                                                                                                <h4>{{ $item->description }}</h4>
                                                                                                <div class="testimonials-blob"></div>
                                                                                                <div class="testimonials-img"><img class="lozad" data-src="/uploads/{{ $item->img }}" alt="{{ $item->title }}"></div>
                                                                                                <div class="testimonials-person-info">
                                                                                                <p><b>{{ $item->title }}</b><br />Thực tập sinh</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
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
            </div>
        </div>
    </div>
</div>
<div class="gbb-row-wrapper">
    <div class=" gbb-row bg-size-cover " style="">
        <div class="bb-inner">
            <div class="bb-container container">
                <div class="widget gsc-heading align-center style-2 text-dark wow fade-up animated">
                    <h2 class="title home-title_v1"><span class="green">{{ setting('section4_title') }}</span></h2>
                    <div class="title-icon"><span><i class="fa fa-puzzle-piece"></i></span></div>
                    <div class="title-desc">
                        <p>{{ setting('section4_desc') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="row-wrapper clearfix">
                        @foreach (\sliders(\setting('progress')) as $item)
                            <div class="gsc-column col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                                <div class="column-inner bg-size-cover ">
                                    <div class="column-content-inner">
                                        <div class="gsc-image-content skin-v2 wow fade-up animated">
                                            <div class="image">
                                                <img class="progress-v1--image lozad" data-src="{{ !is_null($item->img) ? '/uploads/'.$item->img : \setting('noimage') }}" alt="{{ $item->title }}">
                                                <span class="progress-number">{{ $item->order }} </span>
                                            </div>
                                            <div class="box-content progress-v1--box-content">
                                                <h4 class="title">{{ $item->title }}</h4>
                                                <div class="desc">{!! $item->description !!}</div>
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
    </div>
</div>
<div class="gbb-row-wrapper">
    <div class=" gbb-row  bg-size-cover " style="">
        <div class="bb-inner default">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="column-inner  bg-size-cover  ">
                                <div class="column-content-inner">
                                    <div class="widget gsc-heading  align-center style-2 text-dark  wow fade-up animated"
                                        style="visibility: visible; animation-name: fadeInUp;">
                                        <h2 class="title home-title_v1"><span class="green">{{ setting('section5_title') }}</span></h2>
                                        <div class="title-icon"><span><i class="fa fa-rss"></i></span></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="gsc-tab-views block widget gsc-tabs-views-ajax  style-1 wow fade-up animated"
                                        data-wow-delay="0.2s"
                                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="block-content">
                                            <div class="list-links-tabs clearfix">
                                                <ul class="nav nav-tabs links-ajax" data-load="ajax">
                                                    <li class="active"><a href="javascript:void(0);"
                                                            data-panel="#tab-item-xwcij1">Mới nhất</a></li>
                                                    <li class=""><a href="javascript:void(0);"
                                                            data-panel="#tab-item-xwcij2">Nổi bật</a></li>
                                                    <li class=""><a href="javascript:void(0);"
                                                            data-panel="#tab-item-xwcij3">Tin tức</a></li>
                                                    <li class=""><a href="javascript:void(0);"
                                                            data-panel="#tab-item-xwcij4">Cẩm nang</a></li>
                                                    <li class=""><a href="javascript:void(0);"
                                                            data-panel="#tab-item-xwcij5">Nhật Bản</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs-container clearfix">
                                                <div class="ajax-loading"></div>
                                                <div class="tab-content tab-content-view">
                                                    <div data-loaded="false" data-view="block-moi-nhat"
                                                        class="tab-pane clearfix fade in" id="tab-item-xwcij1">
                                                    </div>
                                                    <div data-loaded="false" data-view="block-noi-bat"
                                                        class="tab-pane clearfix fade in" id="tab-item-xwcij2"></div>
                                                    <div data-loaded="false" data-view="tin-tuc"
                                                        class="tab-pane clearfix fade in" id="tab-item-xwcij3"></div>
                                                    <div data-loaded="false" data-view="cam-nang"
                                                        class="tab-pane clearfix fade in" id="tab-item-xwcij4"></div>
                                                    <div data-loaded="false" data-view="xuat-khau-lao-dong-nhat-ban"
                                                        class="tab-pane clearfix fade in" id="tab-item-xwcij5"></div>
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
{{-- <div class="gbb-row-wrapper">
    <div class=" gbb-row bg-size-cover " style="">
        <div class="bb-inner remove_padding_top">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        @foreach ($listCategory as $item)
                            <div class="gsc-column col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
                                <div class="column-inner bg-size-cover ">
                                    <div class="column-content-inner">
                                        <div class="gsc-image-content skin-v2 wow fade-up animated">
                                            <div class="image">
                                                <a href="/category/{{ $item->slug }}"><img class="lozad" data-src="{{ !is_null($item->img) ? '/uploads/'.$item->img : \setting('noimage') }}" alt="{{ $item->title }}"></a>
                                            </div>
                                            <div class="box-content">
                                                <h4 class="title"> <a href="/category/{{ $item->slug }}"> {{ $item->title }} </a> </h4>
                                                <div class="desc"></div>
                                                <div class="read-more"><a href="/category/{{ $item->slug }}">Xem thêm<i class="gv-icon-165"></i></a></div>
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
    </div>
</div> --}}
<div class="gbb-row-wrapper">
    <div class=" gbb-row  bg-size-cover " style="padding-top:30px; background-color:#f5f5f5">
        <div class="bb-inner remove_padding_top">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="column-inner  bg-size-cover  ">
                                <div class="column-content-inner">
                                    <div class="widget gsc-heading  align-center style-2 text-dark  wow fade-up animated"
                                        style="visibility: visible; animation-name: fadeInUp;">
                                        <h2 class="title home-title_v1"><span class="green">{{ setting('section6_title') }}</span></h2>
                                        <div class="title-icon"><span><i class="fa fa-users"></i></span></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div>
                                        <div class="widget block clearfix gsc-block-view  gsc-block-drupal block-view title-align-left  text-dark remove-margin-off wow fade-up animated"
                                            data-wow-delay="0.2s"
                                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                            <div class="views-element-container">
                                                <div>
                                                    <div class="owl-carousel init-carousel-owl owl-loaded owl-drag"
                                                        data-items="4" data-items_lg="4" data-items_md="4"
                                                        data-items_sm="2" data-items_xs="2" data-loop="0"
                                                        data-speed="200" data-auto_play="0" data-auto_play_speed="1000"
                                                        data-auto_play_timeout="3000" data-auto_play_hover="1"
                                                        data-navigation="1" data-rewind_nav="0" data-pagination="0"
                                                        data-mouse_drag="1" data-touch_drag="1">
                                                            @foreach (\sliders(\setting('team')) as $item)
                                                                <div class="item">
                                                                    <div>
                                                                        <div class="team-block team-teaser-1">
                                                                            <div class="team-image">
                                                                                <div
                                                                                    class="field field--name-field-team-image field--type-image field--label-hidden field__item">
                                                                                    <a href="#"
                                                                                        hreflang="vi"><img
                                                                                            src="/uploads/{{ $item->img }}"
                                                                                            alt="{{ $item->description }}"
                                                                                            typeof="foaf:Image">
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="team-content">
                                                                                <div class="team-name"><a
                                                                                        href="#">{{ $item->title }}</a></div>
                                                                                <div class="team-job"><a style="color: red" href="tel:{{ \setting('phone') }}"> <b>{{ \setting('phone') }}</b></a></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
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
<div id="bkgOverlay" class="backgroundOverlay"></div>
@endsection

@push('scripts')

<script>
    var drupalSettings = {
        gavias_load_ajax_view : "/load/ajax_view",
    };
    // var app = new Loader();
    app.sliderHome();
    jQuery(document).ready(function () {
	var app = new Loader();
	app.require([
		"/vendor/input-mask/moment.min.js",
		"/vendor/input-mask/jquery.inputmask.bundle.min.js"],
		function() {
			// Callback
			app.validateDate();
		});
        jQuery("ul.links-ajax li").first().find('a').click();
    });
</script>
@endpush

@push('schema')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Xuất khẩu lao động đi Nhật Bản",
      "provider": {
      "@type": "LocalBusiness",
      "logo":"https://nozomijapan.vn/photos/1/logo/logo-4.png",
      "name": "Công Ty Cổ Phần Thương Mại Quốc Tế NozomiJapan",
      "image": "https://nozomijapan.vn/photos/1/logo/logo-4.png",
      "@id": "https://nozomijapan.vn",
      "url": "https://nozomijapan.vn",
      "description": "Công Ty Cổ Phần Thương Mại Quốc Tế NozomiJapan mảng xuất khẩu lao động, tss, du học sinh đi Nhật Bản",
      "email":"xkld@nozomijapan.vn",
      "telephone": "0989515151",
      "priceRange":"750000-450000000",
      "hasMap":"https://www.google.com/maps/place/C%C3%94NG+TY+C%E1%BB%94+PH%E1%BA%A6N+TH%C6%AF%C6%A0NG+M%E1%BA%A0I+QU%E1%BB%90C+T%E1%BA%BE+NOZOMI+JAPAN/@21.0207021,105.8073086,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x62050129f61d170b!8m2!3d21.0207021!4d105.8094973",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Tầng 5, Toà nhà M5, số 91 Nguyễn Chí Thanh, Đống Đa, Hà Nội",
        "addressLocality": "Hà Nội",
        "postalCode": "100000",
        "addressCountry": "VN"},
      "slogan":"Chúng tôi luôn hỗ trợ tốt nhất cho người lao động Việt Nam tại Nhật Bản",
      "award":"Top 1 xuất khẩu lao động Nhật Bản",
      "mainEntityOfPage":{"@type":"webpage","@id":"https://nozomijapan.vn/gioi-thieu/#webpage"},
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 21.0206986,
        "longitude": 105.8094958},
      "knowsLanguage":["vi","en"],
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "08:00",
        "closes": "17:00"
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Tuyển dụng lao động đi làm việc tại Nhật",
        "itemListElement": [
        {"@type":"service","@id":"https://nozomijapan.vn/don-hang#service","name":"Đơn hàng xuất khẩu lao động Nhật Bản","url":"https://nozomijapan.vn/don-hang"},
        {"@type":"ListItem","item":{"@type":"service","@id":"https://nozomijapan.vn/xuat-khau-lao-dong-nhat/#service","name":"Xuất khẩu lao động Nhật Bản","url":"https://nozomijapan.vn/xuat-khau-lao-dong-nhat"}},
        {"@type":"ListItem","item":{"@type":"service","@id":"https://nozomijapan.vn/category/cam-nang-du-hoc-nhat-ban/#service","name":"Du học Nhật Bản","url":"https://nozomijapan.vn/category/cam-nang-du-hoc-nhat-ban"}},
        {"@type":"ListItem","item":{"@type":"course","@id":"https://nozomijapan.vn/category/lop-tieng-nhat-n3/#course","name":"Lớp học tiếng nhật N3","url":"https://nozomijapan.vn/category/lop-tieng-nhat-n3",
        "description":"Khóa học tiếng nhật N3","provider":{"@id":"kg:/g/11bzvbqpnh","name":"nozomijapan"}}},
        {"@type":"ListItem","item":{"@type":"course","@id":"https://nozomijapan.vn/category/lop-tieng-nhat-n4/#course","name":"Lớp học tiếng nhật N4","url":"https://nozomijapan.vn/category/lop-tieng-nhat-n4",
        "description":"Khóa học tiếng nhật sơ cấp N4","provider":{"@id":"kg:/g/11bzvbqpnh","name":"nozomijapan"}}},
        {"@type":"ListItem","item":{"@type":"course","@id":"https://nozomijapan.vn/category/lop-tieng-nhat-n5/#course","name":"Lớp học tiếng nhật N5","url":"https://nozomijapan.vn/category/lop-tieng-nhat-n5",
        "description":"Khóa học tiếng nhật sơ cấp N5","provider":{"@id":"kg:/g/11bzvbqpnh","name":"nozomijapan"}}}]},
        "sameAs":[
        "https://www.facebook.com/xuatkhaulaodongnhatban.nozomijapan",
        "https://www.youtube.com/channel/UCIL94oV5pFrfrF6e49-9Mfg",
        "https://www.pinterest.com/NozomiJapanXKLDNhatBan/"]},
        "@graph":{"@type": "WebSite",
        "@id":"https://nozomijapan.vn/#website",
        "name": "Nozomi Japan",
        "url": "https://nozomijapan.vn",
        "award":"Top 1 công ty xuất khẩu lao động đi nhật bản uy tín",
        "description":"Website nozomijapan.vn là website thuộc sở hữu của công ty Cổ Phần Thương Mại Quốc Tế NozomiJapan, Nơi chuyên tuyển du học sinh, xuất khẩu lao động, thực tập sinh làm việc tại Nhật Bản LƯƠNG CAO, xuất cảnh NHANH, KHÔNG phí môi giới.",
        "about":{"@type":"webpage","@id":"https://nozomijapan.vn/xuat-khau-lao-dong-nhat/#webpage","name":"Xuất khẩu lao động nhật bản",
        "headline":"XUẤT KHẨU LAO ĐỘNG NHẬT",
        "primaryImageOfPage":{"@id":"https://nozomijapan.vn/#primaryimage"},
        "description":"Nozomi Japan chuyên tuyển dụng xuất khẩu lao động, thực tập sinh nam nữ đi làm việc ở Nhật Bản, LƯƠNG CAO, xuất cảnh NHANH, KHÔNG phí môi giới.",
        "url":"https://nozomijapan.vn/xuat-khau-lao-dong-nhat",
        "inLanguage":"Vi-VN",
        "isPartOf":{"@id":"https://nozomijapan.vn/#website"}},
        "potentialAction": {
          "@type": "SearchAction",
          "target": "https://nozomijapan.vn/search/?s={search_term_string}https://nozomijapan.vn/don-hang,https://nozomijapan.vn/xuat-khau-lao-dong-nhat",
          "query-input": "required name=search_term_string"
        }}
      }
</script>
@endpush
