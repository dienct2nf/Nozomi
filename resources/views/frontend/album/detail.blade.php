@extends('layouts.frontend')
@section('title', $album->name)
@section('description', $album->description)
@section('keywords', str_replace(' ', ' ,', $album->name))
@section('content')
<div class="breadcrumbs">
    <div>
        <div class="breadcrumb-content-inner">
            <div class="gva-breadcrumb-content">
                <div id="block-gavias-unix-breadcrumbs" class="text-light block gva-block-breadcrumb block-system block-system-breadcrumb-block no-title">
                    <div class="breadcrumb-style" style="background-image: url('/photos/1/background/breadcrumb.jpg');background-position: center center;background-repeat: repeat;">
                        <div class="container">
                            <div class="breadcrumb-content-main">
                                <h2 class="page-title"> {{ $album->name }} </h2>
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> {{ $album->name }} <span class=""></span> </li>
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
    <div class="clearfix"></div>
    <div id="content" class="content content-full">
        <div class="container container-bg">
            <div class="content-main-inner">
                <div class="row">
                    <div class="main-content col-md-12 col-xs-12">
                        <div class="main-content-inner">
                            <div class="content-main">
                                <div>
                                    <div class="block block-system block-system-main-block no-title">
                                        <div class="content block-content">
                                            <article data-history-node-id="48" role="article" about="/drupal/unix/index.php/node/48" class="node node-detail node--type-gallery node--promoted node--view-mode-full clearfix">
                                                <div class="single-gallery" id="single-gallery">
                                                    <div class="post-content">
                                                        <div id="gva-pajax-get-content">
                                                            <div class="gallery-images">
                                                                <div>
                                                                    <div class="owl-carousel init-carousel-owl owl-loaded owl-drag"
                                                                    data-items="1"
                                                                    data-items_lg="1"
                                                                    data-items_md="1"
                                                                    data-items_sm="1"
                                                                    data-items_xs="1"
                                                                    data-loop="1"
                                                                    data-speed="500"
                                                                    data-auto_play="1"
                                                                    data-auto_play_speed="2000"
                                                                    data-auto_play_timeout="5000"
                                                                    data-auto_play_hover="1"
                                                                    data-navigation="1"
                                                                    data-rewind_nav="0"
                                                                    data-pagination="1"
                                                                    data-mouse_drag="1"
                                                                    data-touch_drag="1">
                                                                    @php  ($data = $album->loadMedia(['original']) )
                                                                    @foreach ($data->media as $row)
                                                                        <div class="item">
                                                                            <img src="/uploads/{{  $row->getDiskPath() }}" alt="{{ $album->name }}" typeof="foaf:Image">
                                                                        </div>
                                                                    @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="gallery-body">
                                                            <h1 class="post-title"><span>{{ $album->name }}</span></h1>
                                                            <div class="node__content clearfix">
                                                                <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                                    {!! $album->content !!}
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
</div>
@endsection

@push('scripts')
@endpush
