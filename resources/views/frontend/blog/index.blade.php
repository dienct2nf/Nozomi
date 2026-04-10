@extends('layouts.frontend')
@section('title', 'Blog - '.\setting('title'))
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
                                <h2 class="page-title"> Thể loại </h2>
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> Thể loại</li>
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
<div class="container main-wrapper">
    <div class="inner-page margin-default">
        <div class="row">
            <div class="main-content col-md-12 col-xs-12">
                <div class="main-content-inner">
                    <div class="content-main">
                        <div>
                            <div class="block block-system block-system-main-block no-title">
                                <div class="content block-content">
                                    <div class="views-element-container">
                                        <div class="post-style-grid">
                                            <div class="gva-view view-page views-view-grid post-masonry-style row horizontal clearfix">
                                                @foreach ($post as $item)
                                                    <div class="views-col col-lg-4 col-md-4 col-sm-4 col-xs-12 item-masory">
                                                        <div class="post-block">
                                                            <div class="post-image">
                                                                <div class="field__item">
                                                                    <a href="/{{ $item->slug }}">
                                                                        <img property="schema:image" src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail') }}" alt="{{ $item->title }}" typeof="foaf:Image">
                                                                        </a>
                                                                </div>
                                                            </div>
                                                            <div class="post-content text-left">
                                                                <div class="post-title">
                                                                    <a href="/{{ $item->slug }}" rel="bookmark">
                                                                        <span property="schema:name">{{ $item->title }}</span>
                                                                    </a>
                                                                </div>
                                                                <div class="post-body">
                                                                    <div property="schema:text" class="field__item">{{ $item->description }}</div>
                                                                </div>
                                                                <div class="post-bottom">
                                                                    <div class="post-meta">
                                                                        <span class="post-categories">
                                                                            <span class="post-categories">
                                                                                <a href="/category/{{ $item->categories->first()->slug }}">{{ $item->categories->first()->title }}</a>
                                                                            </span>
                                                                        </span>-
                                                                        <span class="post-created"> {{ $item->created_at->format('d/m/Y') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                        </div>
                                        {{ $post->links('vendor.pagination.page') }}
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
