<?php

namespace App\Repositories\Eloquent;

use App\Models\Menu;
use App\Models\MenuItems;
use App\Repositories\MenuRepositoryInterface;
use Illuminate\Support\Collection;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;
    /**
     * @var MenuItems
     */
    protected $menuitem;

   /**
    * Menu constructor.
    *
    * @param Menu $model
    */
   public function __construct(Menu $model, MenuItems $menuitem)
   {
       parent::__construct($model);
       $this->menuitem = $menuitem;
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();
   }

   /**
    * create menu
    * @param string $request
    * @return array
    */
    public function createNewMenu($request): string
    {
        $menu = $this->model->create(['name' => $request->input('name')]);
        return response()->json([
            'resp' => $menu->id
        ]);
        return json_encode(array("resp" => $menu->id));
    }

    /**
     * update item database
     * @param $request
     */
    public function updateItem($request): bool
    {
        $arraydata = $request->input('arraydata');
        if (is_array($arraydata)) {
            $arraydata = (array) $arraydata;
            if (count($arraydata) == 0) {
                return false;
            }
            foreach ($arraydata as $value) {
                $menuitem = $this->menuitem->find($value['id']);
                $menuitem->update(
                    [
                        'label' => $value['label'],
                        'link' => $value['link'],
                        'class' => $value['class'],
                    ]);
            }
        } else {
            $menuitem = $this->menuitem->find($request->input('id'));
            $menuitem->update(
                [
                    'label' => $value['label'],
                    'link' => $value['url'],
                    'class' => $value['clases'],
                ]);
        }
        return true;
    }

    /**
     * add item database
     * @param $request
     */
    public function addCustomMenu($request) : string
    {
        $array = [
            'label' => $request->input('labelmenu'),
            'link' => $request->input('linkmenu'),
            'menu' => $request->input('idmenu'),
            'sort' => $this->menuitem->getNextSortRoot($request->input('idmenu'))
        ];
        $menuitem = $this->menuitem->create($array);
        return json_encode(array("resp" => $menuitem->id));
    }

    /**
     * generatemenu controller
     * @param $request
     * @return string
     */
    public function generateMenuControl($request) : string
    {
        $menu = $this->model->find($request->input('idmenu'));
        $menu->update([
            'name' => $request->input('name')
            ]);
        if (is_array($request->input('arraydata'))) {
            foreach ($request->input('arraydata') as $value) {

                $menuitem = $this->menuitem->find($value['id']);
                $menuitem->update([
                        'parent' => $value['parent'],
                        'sort' => $value['sort'],
                        'depth' => $value['depth'],
                    ]);
            }
        }
        return json_encode(array("resp" => 1));

    }

    /**
     * delete item menu
     * @param $request
     * @return string
     */

    public function deleteItemMenu($request) : string
    {
        $menuitem = $this->menuitem->find($request->input('id'));

        $menuitem->delete();
        return json_encode(array("resp" => "you delete this item"));
    }

    /**
     * delete menu
     * @param $request
     * @return string
     */

    public function deleteMenu($request)
    {
        $getall = $this->menuitem->getall($request->input('id'));
        if (count($getall) == 0) {
            $menuDelete = $this->model->find($request->input('id'));
            $menuDelete->delete();

            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));

        }
    }
}
