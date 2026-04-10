@extends('layouts.frontend')
@section('title', !empty(widgets(setting('widget_letter'))->first())? widgets(setting('widget_vision'))->first()->title : \setting('title'))
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
                                                <h2 id="system-breadcrumb" class="visually-hidden">{{ !empty(widgets(setting('widget_vision'))->first())? widgets(setting('widget_vision'))->first()->title : '' }}</h2>
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> </li>
                                                    <li> {{ !empty(widgets(setting('widget_vision'))->first())? widgets(setting('widget_vision'))->first()->title : '' }} </li>
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
	<div class="bb-inner ">
        <div class="bb-container container">
            <div class="row">
                <div class="row-wrapper clearfix">
                    {!! !empty(widgets(setting('widget_vision'))->first())? widgets(setting('widget_vision'))->first()->description : '' !!}
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
    });
</script>
@endpush
