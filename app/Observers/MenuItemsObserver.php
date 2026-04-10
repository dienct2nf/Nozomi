<?php

namespace App\Observers;

use App\Models\MenuItems;

class MenuItemsObserver
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
     * Handle the menu items "created" event.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return void
     */
    public function created(MenuItems $menuItems)
    {
        $this->cache;
    }

    /**
     * Handle the menu items "updated" event.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return void
     */
    public function updated(MenuItems $menuItems)
    {
        $this->cache;
    }

    /**
     * Handle the menu items "deleted" event.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return void
     */
    public function deleted(MenuItems $menuItems)
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
