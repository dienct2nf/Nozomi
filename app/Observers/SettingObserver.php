<?php

namespace App\Observers;

use App\Models\Setting;

class SettingObserver
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
        $this->cache = self::RemoveCacheSetting();
    }

    /**
     * Handle the setting "created" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        $this->cache;
    }

    /**
     * Handle the setting "updated" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        $this->cache;
    }

    /**
     * Handle the setting "deleted" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        $this->cache;
    }

    /**
     * remove cache
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */

    public function RemoveCacheSetting(){
        return \Cache::forget('settings.all');
    }
}
