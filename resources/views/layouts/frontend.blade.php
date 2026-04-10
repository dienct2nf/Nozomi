<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile specific meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- PAGE TITLE -->
    <title>@yield('title')</title>
    <!-- SEO METAS -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ \setting('author') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SEO METAS SOCIAL -->
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="@yield('url')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('img')" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@vietcom">
    <meta name="twitter:creator" content="@vietcom" />
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('img')">
    <meta property="fb:app_id" content="349921872920354" />

    <link rel="canonical" href="@yield('url')">
    <meta name="google-site-verification" content="{{ \setting('google_master') }}">
    <!-- PAGE FAVICON -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    @stack('css')
    <link rel="stylesheet" href="{{ asset('themes/ollis/assets/lib/layui/css/layui.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/default/css/style.css') }}?v={{ date('d-m-Y') }}"
        type="text/css" media="all" />
    @stack('schema')

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M6ZVCLL');
    </script>
    <!-- End Google Tag Manager -->

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M6ZVCLL"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-inner">
                <div class="row">
                    <div class="topbar-left col-sm-6 col-xs-6">
                        <div class="social-list">
                            <a href="{{ \setting('facebook') }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ \setting('twitter') }}"><i class="fa fa-twitter-square"></i></a>
                            <a href="{{ \setting('instagram') }}"><i class="fa fa-instagram"></i></a>
                            <a href="{{ \setting('pinterest') }}"><i class="fa fa-pinterest"></i></a>
                            <a href="{{ \setting('youtube') }}"><i class="fa fa-youtube-square"></i></a>
                        </div>
                    </div>
                    <div class="topbar-right col-sm-6 col-xs-6">
                        <ul class="gva_topbar_menu">
                            <li><a href="/contact"><strong>Đăng ký tư vấn miễn phí</strong></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header id="header" class="header-v1">
        <div class="sticky-wrapper" style="">
            <div class="header-main gv-sticky-menu">
                <div class="container header-content-layout">
                    <div class="header-main-inner p-relative">
                        <div class="row">
                            <div class="col-md-2 col-sm-6 col-xs-8 branding">
                                <div>
                                    <a href="/" title="Home" rel="home" class="site-branding-logo-v1">
                                        <img src="{{ \setting('logo') }}" alt="logo" class="img-logo">
                                        <h1 style="display: none;">Xuất khẩu lao động Nhật Bản uy tín, chi phí cực ưu đãi, đỗ đơn hàng 100%</h1>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-4 p-static">
                                <div class="header-inner clearfix">
                                    <div class="main-menu">
                                        <div class="area-main-menu">
                                            <div class="area-inner">
                                                <div class="gva-offcanvas-mobile">
                                                    <div class="close-offcanvas hidden"><i class="fa fa-times"></i></div>
                                                    <div>
                                                        <nav role="navigation"
                                                            aria-labelledby="block-gavias-unix-mainnavigation-menu"
                                                            id="block-gavias-unix-mainnavigation"
                                                            class="block block-menu navigation menu--main">
                                                            <div class="block-content">
                                                                <div class="gva-navigation">
                                                                    <ul class="clearfix gva_menu gva_menu_main">
                                                                        @foreach(menu('menu_header') as $menu)
                                                                        <li
                                                                            class="{{ (count($menu['child']) > 0) ? 'menu-item menu-item--expanded' : 'menu-item' }} {{ ($menu['link'] == 'http://nozomijapan.vn/') ? 'menu-item--active-trail' : '' }}">
                                                                            <a href="{{ $menu['link'] }}"> {{ $menu['label'] }} {!! (count($menu['child']) > 0) ? '<span class="icaret nav-plus fa fa-angle-down"></span>' : '' !!}
                                                                            </a>
                                                                            @if( $menu['child'] )
                                                                            <ul class="menu sub-menu">
                                                                                @foreach( $menu['child'] as $child )
                                                                                <li
                                                                                    class="menu-item menu-item--active-trail">
                                                                                    <a href="{{ $child['link'] }}"> {{ $child['label'] }}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                            @endif
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <div id="menu-bar" class="menu-bar hidden-lg hidden-md"> <span
                                                        class="one"></span> <span class="two"></span> <span
                                                        class="three"></span> </div>
                                                <div class="gva-search-region search-region"> <span class="icon"><i
                                                            class="fa fa-search"></i></span>
                                                    <div class="search-content">
                                                        <div>
                                                            <div class="search-block-form block block-search container-inline"
                                                                data-drupal-selector="search-block-form"
                                                                id="block-gavias-unix-searchform" role="search">
                                                                <form action="/search/" method="get" id="search-block-form" accept-charset="UTF-8"
                                                                    class="search-form search-block-form">
                                                                    <div
                                                                        class="js-form-item form-item js-form-type-search form-item-keys js-form-item-keys form-no-label">
                                                                        <label for="edit-keys"
                                                                            class="visually-hidden">Tìm kiếm</label>
                                                                        <input
                                                                            title="Nhập từ khóa tìm kiếm."
                                                                            data-drupal-selector="edit-keys"
                                                                            type="search" id="edit-keys" name="s"
                                                                            value="" size="15" maxlength="128"
                                                                            class="form-search">
                                                                    </div>
                                                                    <div data-drupal-selector="edit-actions"
                                                                        class="form-actions js-form-wrapper form-wrapper"
                                                                        id="edit-actions">
                                                                        <input
                                                                            class="search-form__submit button js-form-submit form-submit"
                                                                            data-drupal-selector="edit-submit"
                                                                            type="submit" id="edit-submit"
                                                                            value="Tìm">
                                                                    </div>
                                                                </form>
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
    </header>
    <div class="node__content clearfix">
        <div class="field field--name-field-content-builder field--type-gavias-content-builder field--label-hidden field__item">
            <div class="gavias-blockbuilder-content">
                <div class="gavias-builder--content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" class="footer">
        <div class="footer-inner">
            <div class="footer-center">
                <div class="container">
                    <div class="row">
                        <div class="footer-first col-lg-6 col-md-6 col-sm-12 col-xs-12 column">
                            <div>
                                <div id="block-gavias-unix-contactinfo"
                                    class="block block-block-content block-block-content7da38301-272f-4979-8de1-06b564010f17">
                                    <h2 class="block-title"><span>Thông tin liên hệ</span></h2>
                                    <div class="content block-content">
                                        <div
                                            class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                            <div class="contact-info"> <span class="description">{{ \setting('description') }}</span>
                                                <ul class="contact-info">
                                                    <li><span><i class="fa fa-home"></i> {{ \setting('location_hanoi') }}</span></li>
                                                    <li><span><i class="fa fa fa-map-marker"></i> {{ \setting('location_tphcm') }}</span></li>
                                                    <li><span><i class="fa fa fa-map-marker"></i> {{ \setting('location_japan') }} </span></li>
                                                    <li><span><i class="fa fa-mobile-phone"></i> <a href="tel:{{ \setting('phone') }}">{{ \setting('phone') }}</a></span></li>
                                                    <li><a href="mailto:{{ \setting('email') }}"><i class="fa fa-envelope-o"></i> {{ \setting('email') }}</a></li>
                                                    {{-- <li><span><i class="fa fa-skype"></i> {{ \setting('skype') }}</span> </li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-second col-lg-3 col-md-3 col-sm-12 col-xs-12 column">
                            <div>
                                <div id="block-gavias-unix-linkfooter"
                                    class="block block-block-content block-block-contentf68ff84d-6af0-4c49-8b85-ae338addc541">
                                    <h2 class="block-title"><span>Truy cập nhanh</span></h2>
                                    <div class="content block-content">
                                        <div
                                            class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                            <div class="clearfix">
                                                <ul class="menu">
                                                    @foreach(menu('menu_footer') as $menu)
                                                    <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-second col-lg-3 col-md-3 col-sm-12 col-xs-12 column">
                            <div>
                                <div id="block-gavias-unix-linkfooter"
                                    class="block block-block-content">
                                    <h2 class="block-title"><span>Kết nối với chúng tôi</span></h2>
                                    <div class="footer-social">
                                        <ul>
                                            <li>
                                                <a href="{{ setting('facebook') }}">
                                                    <i class="fa fa-facebook-square"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting('twitter') }}">
                                                    <i class="fa fa-twitter-square"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting('skype') }}">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting('instagram') }}">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting('pinterest') }}">
                                                    <i class="fa fa-pinterest"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting('youtube') }}">
                                                    <i class="fa fa-youtube-square"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="content block-content" style="margin-top: 10px;">
                                        <a href="//www.dmca.com/Protection/Status.aspx?ID=c6a72f73-445d-453b-9b73-6b0b26a5cde0" title="DMCA.com Protection Status" class="dmca-badge">
                                            <img src="https://images.dmca.com/Badges/DMCA_logo-grn-btn200w.png?ID=c6a72f73-445d-453b-9b73-6b0b26a5cde0" alt="DMCA.com Protection Status" />
                                        </a>
                                        <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="hotline-phone-ring-wrap">
                <div class="hotline-phone-ring">
                    <div class="hotline-phone-ring-circle"></div>
                    <div class="hotline-phone-ring-circle-fill"></div>
                    <div class="hotline-phone-ring-img-circle">
                        <a href="tel:{{ setting('phone') }}" class="pps-btn-img"> <img src="/themes/default/css/images/icon.png" alt="so dien thoai" width="50"> </a>
                    </div>
                </div>
                <div class="hotline-bar">
                    <a href="tel:{{ setting('phone') }}"> <span class="text-hotline">{{ setting('phone') }}</span> </a>
                </div>
            </div>

            <div class="float-icon-hotline">
                <ul class="left-icon hotline">
                    <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="https://zalo.me/{{ setting('app_zalo') }}"><i class="fa fa-zalo animated infinite tada"></i><span>Zalo</span></a></li>
                    <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="https://www.messenger.com/t/{{ setting('app_messenger') }}"><i class="fa fa-messenger animated infinite tada"></i><span>Facebook</span></a></li>
                </ul>
            </div>
            <div class="container">
                <div class="copyright-inner">
                    <div>
                        <div id="block-gavias-unix-copyright"
                            class="block block-block-content block-block-content61f17841-749f-436d-9799-1dfeefd7ad43 no-title">
                            <div class="content block-content">
                                <div
                                    class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <div class="text-center">© Copyright <a
                                            href="/">Nozomi</a> {{ date('Y') }}. All Rights
                                        Reserved. </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="gva-popup-ajax" class="clearfix">
            <div class="pajax-content"><a href="javascript:void(0);" class="btn-close"><i class="gv-icon-4"></i></a>
                <div class="gva-popup-ajax-content clearfix"></div>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="{{ asset('themes/default/js/nozomi.min.js') }}?v={{ date('d-m-Y') }}"></script>

    <script src="{{ asset('themes/ollis/assets/lib/layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/default/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{ asset('themes/default/js/custom.js') }}?v={{ date('d-m-Y') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/lozad/lozad.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            const observer = lozad();
            observer.observe();
        });

        var app = new Loader();
    </script>
    {!! \setting('google_analytics') !!}
    @stack('scripts')
</body>

</html>