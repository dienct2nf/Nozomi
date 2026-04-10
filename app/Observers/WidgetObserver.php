<?php

namespace App\Observers;

use App\Models\Widget;

class WidgetObserver
{

    public $cache;


    /**
     * load cache
     */
    public function __construct()
    {
        $this->cache = self::RemoveCacheWidget();
    }

    /**
     * Handle the widget "created" event.
     *
     * @param  \App\Models\Widget  $widget
     * @return void
     */
    public function created(Widget $widget)
    {
        $this->cache;
    }

    /**
     * Handle the widget "updated" event.
     *
     * @param  \App\Models\Widget  $widget
     * @return void
     */
    public function updated(Widget $widget)
    {
        $this->cache;
    }

    /**
     * Handle the widget "deleted" event.
     *
     * @param  \App\Models\Widget  $widget
     * @return void
     */
    public function deleted(Widget $widget)
    {
        $this->cache;
    }

    /**
     * Handle the widget "force deleted" event.
     *
     * @param  \App\Models\Widget  $widget
     * @return void
     */
    public function RemoveCacheWidget(){
        return \Cache::forget('widgets.all');
    }
}
