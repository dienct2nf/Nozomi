@extends('layouts.frontend')
@section('title', $tag->title)
@section('description', $tag->title)
@section('keywords', str_replace(' ', ' ,', $tag->title))
@section('img', \setting('thumbnail'))
@section('url', url('/tag/'.$tag->slug))
@section('content')
<div class="breadcrumbs">
    <div>
        <div class="breadcrumb-content-inner">
            <div class="gva-breadcrumb-content">
                <div id="block-gavias-unix-breadcrumbs" class="text-light block gva-block-breadcrumb block-system block-system-breadcrumb-block no-title">
                    <div class="breadcrumb-style" style="background-image: url('/photos/1/background/breadcrumb.jpg');background-position: center center;background-repeat: repeat;">
                        <div class="container">
                            <div class="breadcrumb-content-main">
                                <h2 class="page-title"> {{ $tag->title }} </h2>
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> {{ $tag->title }}</li>
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
                                    <div class="block block-system block-system-main-block no-title">
                                        <div class="content block-content">
                                            <div class="views-element-container">
                                                <div class="post-style-list">
                                                    <div class="item-list">
                                                        <ul>
                                                            @foreach ($tag->posts()->paginate(5) as $item)
                                                                <li class="view-list-item">
                                                                    <div class="views-field views-field-nothing">
                                                                        <span class="field-content">
                                                                            <div class="post-block">
                                                                                <div class="post-image">
                                                                                    <img src="{{ !is_null($item->img)? '/uploads/'.$item->img : setting('thumbnail') }}" alt="" typeof="Image"></div> <div class="post-content">
                                                                                        <div class="post-title"><a href="/{{$item->slug}}" hreflang="en">{{$item->title}}</a></div>
                                                                                        <div class="post-meta margin-bottom-10"><span class="post-categories"><a href="/category/{{$item->categories->first()->slug}}" hreflang="en">{{$item->categories->first()->title}}</a></span>-<span class="post-created"> {{ $item->created_at->format('d/m/Y') }} </span></div>
                                                                                    <div class="body">{{ $item->description }}</div>
                                                                                    </div>
                                                                                </div>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                {{ $tag->posts()->paginate(5)->links('vendor.pagination.page') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar sidebar-right theiaStickySidebar">
                        <div class="sidebar-inner">
                            <div>
                                <div class="views-element-container block block-views block-views-blockcategories-post-block-1">
                                    <h2 class="block-title"><span>Thể loại</span></h2>
                                    <div class="content block-content">
                                        <div>
                                            <div class="category-list">
                                                <div class="item-list">
                                                    <ul>
                                                        @foreach ($category as $item)
                                                        <li class="view-list-item">
                                                            <div class="views-field views-field-name"><span class="field-content"><a href="/category/{{ $item->slug }}" hreflang="en">{{ $item->title }}</a></span></div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($tags->count() > 0)
                                    <div class="views-element-container block block-views block-views-blockcategories-post-block-2" id="block-gavias-unix-views-block-categories-post-block-2">
                                        <h2 class="block-title"><span>Từ khóa: </span></h2>
                                        <div class="content block-content">
                                            <div>
                                                <div class="tags-list js-view-dom-id-2688e8f0362a16dd2e6e7bf9252864d2e4cb4ecc5db9c6ab5f59dcfe362a986a">
                                                    <div class="item-list">
                                                        <ul>
                                                            @foreach ($tags as $item)
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
@endsection

@push('scripts')
<script>
   app.resetMenu();
</script>
@endpush
