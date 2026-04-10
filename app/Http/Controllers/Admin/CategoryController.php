<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\CategoryRepository;
use App\Http\Requests\Category\CategoryRequest;
use File;
class CategoryController extends Controller
{
    /**
     * CategoryRepository
     * @var categoryRepository
     */
    private $categoryRepository;

    /**
     * categoryRepository constructor.
     * @param categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * show index category
     * @return collection
     */
    public function loadData()
    {
        // $category = $this->categoryRepository->all();
        // return view('admin.category.index', compact('category'));
        $data = $this->categoryRepository->getAllOrderBy();
        $data = $this->categoryRepository->dataTable($data);
        return $data;
    }

    /**
     * form create and edit category
     * @return \Illuminate\Http\Response
     */

     public function index() {
        checkPermission('article-create');
        $listCategories = $this->categoryRepository->listCategoriesToArray('vi');
        $listCategories = $this->categoryRepository->addNone($listCategories);
        $category = [];
        return view('admin.category.create', compact('listCategories', 'category'));
     }

    /**
     * form create and edit category
     * @return \Illuminate\Http\Response
     */

    public function create() {
        checkPermission('article-create');
        $listCategories = $this->categoryRepository->listCategoriesToArray('vi');
        $listCategories = $this->categoryRepository->addNone($listCategories);
        $category = [];
        return view('admin.category.create', compact('listCategories', 'category'));
     }
      /**
     * form create and edit category
     * @return \Illuminate\Http\Response
     */

    public function edit($id) {
        checkPermission('article-edit');
        $category = $this->categoryRepository->find($id);
        $listCategories = $this->categoryRepository->listCategoriesToArray('vi');
        $listCategories = $this->categoryRepository->addNone($listCategories, $id);
        // return $listCategories;
        return view('admin.category.edit', compact('listCategories', 'category'));
     }

     /**
     * form create and edit category
     * @param App\Http\Requests\Category\CategoryRequest;
     */

    public function store(CategoryRequest $request) {
        // validate
        $validated = $request->validated();
        $data_attribute = $this->categoryRepository->attribute($request);
        // return $data_attribute;
        $category = $this->categoryRepository->create($data_attribute);
        //Store Image
        $this->categoryRepository->thumb($request, 'category', $category->id);

        return redirect()->route('category.edit', $category->id)->with('status', 'Category created success!');
    }


     /**
     * update category
     * @param int $id
     * @param array App\Http\Requests\Category\CategoryRequest;
     * @return \Illuminate\Http\Response
     */

    public function update(CategoryRequest $request, $id) {
        // validate
        $validated = $request->validated();
        $data_attribute = $this->categoryRepository->attribute($request);
        // return $data_attribute;
        $category = $this->categoryRepository->update($data_attribute, $id);
        //Store Image
        $media = $this->categoryRepository->thumb($request, 'category', $id);
        return back()->with('status', 'Category update success!');
    }

    /**
     * delete record categoy form database
     * @param int $id
     * @return bool
     */
    public function destroy($id) {
        checkPermission('article-delete');
        $this->categoryRepository->deleteWithMedia($id);
        return redirect()->route('category.index')->with('status', 'Category delete success!');
    }
}
