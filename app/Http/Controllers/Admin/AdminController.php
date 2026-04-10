<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\UserRepository;

class AdminController extends Controller
{
    /**
     * var
     * @var PostRepository
     */
    private $postRepository;

    /**
     * var
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * var
     * @var UserRepository
     */
    private $userRepository;

    /**
     * categoryRepository constructor.
     * @param categoryRepository
     */
    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository
        )
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = $this->postRepository->all();
        $category = $this->categoryRepository->all();
        $user = $this->userRepository->all();
        return view('admin.dashboard', compact('post', 'category', 'user'));
    }

    /**
     * Show media iframe
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function media()
    {
        checkPermission('media-show');
        return view('admin.media.index');
    }

    /**
     * Show media iframe
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function file()
    {
        checkPermission('media-show');
        return view('admin.media.file');
    }
}
