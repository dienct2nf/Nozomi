@extends('layouts.frontend')
@section('title', '404 không tìm thấy')
@section('description', '404 không tìm thấy')
@section('keywords', str_replace(' ', ' ,', '404 không tìm thấy'))
@section('content')
<div class="breadcrumbs">
    <div>
        <div class="breadcrumb-content-inner">
            <div class="gva-breadcrumb-content">
                <div id="block-gavias-unix-breadcrumbs" class="text-light block gva-block-breadcrumb block-system block-system-breadcrumb-block no-title">
                    <div class="breadcrumb-style" style="background-image: url('/photos/1/background/breadcrumb.jpg');background-position: center center;background-repeat: repeat;">
                        <div class="container">
                            <div class="breadcrumb-content-main">
                                <h2 class="page-title"> 404 không tìm thấy </h2>
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> 404 không tìm thấy <span class=""></span> </li>
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
    <div class="content content-full">
        <div class="container container-bg">
            <div class="content-main-inner">
                <div class="row">
                    <div class="main-content col-md-12 col-xs-12">
                        <div class="main-content-inner">
                            <div class="content-main">
                                <div style="min-height: 100px">
                                    <div class="block block-system block-system-main-block no-title">
                                        <div class="content block-content">Không tìm thấy trang yêu cầu. </div>
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
<script type="text/javascript">
    window.location = "/";//here double curly bracket
</script>
@endpush
