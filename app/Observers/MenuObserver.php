<?php

namespace App\Observers;

use App\Models\Menu;

class MenuObserver
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
        $this->cache = self::RemoveCacheMenu();
    }
    /**
     * Handle the menu "created" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        $this->cache;
    }

    /**
     * Handle the menu "updated" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function updated(Menu $menu)
    {
        $this->cache;
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        $this->cache;
    }

    /**
     * remove cache
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */

    public function RemoveCacheMenu(){
        $forget = \Cache::forget('menu.menu_header');
        $forget = \Cache::forget('menu.menu_footer');
        $forget = \Cache::forget('menu.infomation');
        $forget = \Cache::forget('menu.overview');
        return true;
    }
}
