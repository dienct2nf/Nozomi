<?php

namespace App\Providers;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Widget;
use App\Observers\MenuObserver;
use App\Observers\MenuItemsObserver;
use App\Observers\SettingObserver;
use App\Observers\SliderObserver;
use App\Observers\WidgetObserver;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Menu::observe(MenuObserver::class);
        MenuItems::observe(MenuItemsObserver::class);
        Setting::observe(SettingObserver::class);
        Slider::observe(SliderObserver::class);
        Widget::observe(WidgetObserver::class);
    }
}
