<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\MenuRepository;
use Illuminate\Http\Request;


class MenuController extends Controller
{

    /**
     * MenuRepository
     * @var menuRepository
     */
    private $menuRepository;

    /**
     * menuRepository constructor.
     * @param menuRepository
     */
    public function __construct(MenuRepository $menuRepository) {
        $this->menuRepository = $menuRepository;
    }

    /**
     *  show form edit
     * @return Illuminate\Http\Response
     * */
    public function index()
    {
        checkPermission('article-create');
        return view('admin.menu.index');
    }

    /**
     *  show form edit
     * @return Illuminate\Http\Response
     * */
    public function createNewMenu(Request $request)
    {
        checkPermission('article-create');
        return $this->menuRepository->createNewMenu($request);
    }

    /**
     *  show form edit
     * @return Illuminate\Http\Response
     * */
    public function updateItem(Request $request)
    {
        checkPermission('article-edit');
        return $this->menuRepository->updateItem($request);
    }

    /**
     *  show form edit
     * @return Illuminate\Http\Response
     * */
    public function addCumstomMenu(Request $request)
    {
        checkPermission('article-create');
        return $this->menuRepository->addCustomMenu($request);
    }

    /**
     *  show form edit
     * @return Illuminate\Http\Response
     * */
    public function generateMenuControl(Request $request)
    {
        return $this->menuRepository->generateMenuControl($request);
    }

    /**
     *  delete menu
     * @return Illuminate\Http\Response
     * */
    public function deleteMenu(Request $request)
    {
        checkPermission('article-delete');
        return $this->menuRepository->deleteMenu($request);
    }

    /**
     *  delete menu item
     * @return Illuminate\Http\Response
     * */
    public function deleteItemMenu(Request $request)
    {
        checkPermission('article-delete');
        return $this->menuRepository->deleteItemMenu($request);
    }
}
