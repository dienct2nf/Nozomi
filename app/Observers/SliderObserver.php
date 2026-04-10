<?php

namespace App\Observers;

use App\Models\Slider;

class SliderObserver
{

    /**
     * @var $cache;
     */

    public $cache;

    /**
     * load cache
     */
    public function __construct()
    {
        $this->cache = self::RemoveCacheSlider();
    }

    /**
     * Handle the setting "created" event.
     *
     * @param  \App\Models\Slider  $setting
     * @return void
     */
    public function created(Slider $setting)
    {
        $this->cache;
    }

    /**
     * Handle the setting "updated" event.
     *
     * @param  \App\Models\Slider  $setting
     * @return void
     */
    public function updated(Slider $setting)
    {
        $this->cache;
    }

    /**
     * Handle the setting "deleted" event.
     *
     * @param  \App\Models\Slider  $setting
     * @return void
     */
    public function deleted(Slider $setting)
    {
        $this->cache;
    }

    /**
     * remove cache
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */

    public function RemoveCacheSlider(){
        return \Cache::forget('sliders.all');
    }
}
