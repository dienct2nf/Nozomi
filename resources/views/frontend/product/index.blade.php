@extends('layouts.frontend')
@section('title', 'TOP đơn hàng đi xuất khẩu lao động Nhật Bản LƯƠNG 3X Phí Rẻ')
@section('description', 'Tổng hợp đơn hàng xuất khẩu lao động nhật bản lương cao mới nhất dành cho nam, nữ trong độ tuổi lao động')
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
                                <h1 class="page-title"> TOP đơn hàng đi xuất khẩu lao động Nhật Bản LƯƠNG 3X Phí Rẻ</h1>
                                <div class="content block-content">
                                    <div class="breadcrumb-links">
                                        <div class="content-inner">
                                            <nav class="breadcrumb " role="navigation" aria-labelledby="system-breadcrumb">
                                                <ol>
                                                    <li> <a href="/">Trang chủ</a> <span class=""> &rarr; </span> </li>
                                                    <li> Đơn hàng đi Nhật </li>
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
                                        <div class="view-content-wrap">
                                            <table class="rwd-table">
                                                <tbody>
                                                    <tr>
                                                        <th>NGÀNH NGHỀ</th>
                                                        <th>SỐ LƯỢNG</th>
                                                        <th>NƠI LÀM VIỆC</th>
                                                        <th>MỨC LƯƠNG</th>
                                                        <th>ĐĂNG KÝ</th>
                                                    </tr>
                                                    @foreach ($listProduct->paginate(12) as $item)
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
                                                            <span style="display: none"
                                                                class="slot--table">{{ date('d/m/Y', strtotime($item->date)) }}</span>
                                                            <div
                                                                class="enroll--table">
                                                                <a href="/don-hang/{{ $item->slug }}" class="btn-theme">Đăng ký</a>
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
                    <div class="gbb-row-wrapper">
                        <div class="gbb-row bg-size-cover">
                            <div class="bb-inner default" style="padding-top: 0px;">
                                <div class="bb-container container">
                                    <div class="row">
                                      {!! !empty(widgets(setting('widget_product'))->first())? widgets(setting('widget_product'))->first()->description : '' !!}
                                    </div>
                                </div>
                                <section>
                                    <h3>Để lại bình luận</h3>
                                    <div id="fb-root"></div>
                                    
                                    <div class="fb-comments" data-href="{{ url('/don-hang') }}" data-numposts="5" data-width="100%"></div>
                                </section>
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
        "name": "Nozomi Japan",
        "item": "https://nozomijapan.vn"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "Đơn Hàng Đi Nhật",
        "item": "https://nozomijapan.vn/don-hang"
      }]
    }
    </script>
@endpush
