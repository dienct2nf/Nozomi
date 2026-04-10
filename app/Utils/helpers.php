<?php
if ( !function_exists('setting')) {

    function setting($key, $default = null)
    {
        if (is_null($key)) {
            return new \App\Models\Setting();
        }

        if (is_array($key)) {
            return \App\Models\Setting::set($key[0], $key[1]);
        }

        $value = \App\Models\Setting::get($key);

        return is_null($value) ? value($default) : $value;
    }
}
// menu
if ( !function_exists('menu')) {

    function menu($default = 'menu')
    {
        $value = \App\Models\Menu::getAllMenu($default);
        return $value;
    }
}
// locale
if ( !function_exists('locale')) {

    function locale()
    {
        $value = app()->getLocale();
        return $value;
    }
}
// slider
if ( !function_exists('sliders')) {

    function sliders($filter = null)
    {
        $value = \App\Models\Slider::getAllSliders();

        if (is_numeric($filter)) {
            $value = $value->filter(function ($item) use ($filter) {
                if ($item->parent_id == $filter) {
                        return $item;
                }
            });
        }
        if (is_null($filter)) {
            $value = $value->filter(function ($item) {
                if ($item->parent_id == null) {
                        return $item;
                }
            });
        }
        return $value;

    }
}
// check permission
if ( !function_exists('checkPermission')) {

    function checkPermission($permission)
    {
        if (!auth()->user()->can($permission)) {
            abort(403);
        }
    }
}

// format vnd
if ( !function_exists('product_price')) {
    function product_price($priceFloat,  $symbol = 'VNĐ') {
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price.' '.$symbol;
    }
}

// cover link youtuebe to ember
if ( !function_exists('getYoutubeEmbedUrl')) {
    function getYoutubeEmbedUrl($url, $auto=0)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id .'?autoplay='.$auto;
    }
}

// widget

// slider
if ( !function_exists('widgets')) {

    function widgets($filter = null)
    {
        $value = \App\Models\Widget::getAllWidgets();

        if (is_numeric($filter)) {
            $value = $value->filter(function ($item) use ($filter) {
                if ($item->id == $filter) {
                        return $item;
                }
            });
        }

        return $value;

    }
}

if ( !function_exists('sw_get_current_weekday')) {
    function sw_get_current_weekday() {
        $weekday = date("l");
        $weekday = strtolower($weekday);
        switch($weekday) {
            case 'monday':
                $weekday = 'Thứ hai';
                break;
            case 'tuesday':
                $weekday = 'Thứ ba';
                break;
            case 'wednesday':
                $weekday = 'Thứ tư';
                break;
            case 'thursday':
                $weekday = 'Thứ năm';
                break;
            case 'friday':
                $weekday = 'Thứ sáu';
                break;
            case 'saturday':
                $weekday = 'Thứ bảy';
                break;
            default:
                $weekday = 'Chủ nhật';
                break;
        }
        return $weekday.', '.date('d/m/Y');
    }
}
