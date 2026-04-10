<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Http\Requests\Post\PostRequest;


class PostController extends Controller
{
    /**
     * CategoryRepository
     * @var categoryRepository
     */
    private $categoryRepository;

     /**
     * PostRepository
     * @var postRepository
     */
    private $postRepository;

    /**
     * categoryRepository, postRepository constructor.
     * @param categoryRepository
     * @param postRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        PostRepository $postRepository
        ) {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * show index post
     * @return collection
     */
    public function loadData()
    {
        $data = $this->postRepository->getAllOrderBy();
        $data = $this->postRepository->dataTable($data);
        return $data;
    }

    /**
     *  show all article
     * @return view
     */
    public function index() {
        checkPermission('article-show');
        return view('admin.post.index');
    }

    /**
     * form create port
     * @return view
     */
    public function create() {
        checkPermission('article-create');
        $listCategories  = $this->categoryRepository->listCategoriesToArray('vi');
        $listTags  = $this->postRepository->getAllTagsToArray();
        return view('admin.post.create', compact('listCategories', 'listTags'));
    }


    /**
     * insert record in databse
     * @param Illuminate\Http\Request
     * @return redirect
     */
    public function store(PostRequest $request) {
        $data_attribute = $this->postRepository->attribute($request);
        // return $data_attribute;
        $post = $this->postRepository->create($data_attribute);
        $this->postRepository->syncCategory($post->id, $request->category_id);
        $this->postRepository->thumb($request, 'blog', $post->id);
        $this->postRepository->syncTags($request, $post->id);
        return redirect()->route('post.edit', $post->id)->with('status', 'Article created success!');
    }

    /**
     * form create port
     * @return view
     */
    public function edit($id) {
        checkPermission('article-edit');
        $post = $this->postRepository->find($id);
        // return $category_ids;
        $listCategories  = $this->categoryRepository->listCategoriesToArray('vi');
        $listTags  = $this->postRepository->getAllTagsToArray();
        return view('admin.post.edit', compact('listCategories', 'post', 'listTags'));
    }

    /**
     * update category
     * @param int $id
     * @param array App\Http\Requests\Category\CategoryRequest;
     * @return \Illuminate\Http\Response
     */

    public function update(PostRequest $request, $id) {
        // validate
        $validated = $request->validated();
        $data_attribute = $this->postRepository->attribute($request);
        // return $data_attribute;
        $this->postRepository->update($data_attribute, $id);
        //Store Image
        $this->postRepository->syncCategory($id, $request->category_id);
        $this->postRepository->thumb($request, 'blog', $id);
        $this->postRepository->syncTags($request, $id);
        return back()->with('status', 'Article update success!');
    }


    /**
     * delete record categoy form database
     * @param int $id
     * @return bool
     */
    public function destroy($id) {
        $this->postRepository->deleteWithMedia($id);
        return redirect()->route('post.index')->with('status', 'Article delete success!');
    }

    /**
     * fix image
     * @param int $id
     * @return bool
     */
    public function fixImage() {
        $this->postRepository->replaceImageStyle();
        return 'ok';
    }
}
