<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\PostRepository;

class TagController extends Controller
{
    /**
     * PostRepository
     * @var postRepository
     */
    private $postRepository;

    /**
     * categoryRepository, postRepository constructor.
     * @param postRepository
     */
    public function __construct(
        PostRepository $postRepository
        ) {
        $this->postRepository = $postRepository;
    }


    /**
     * show index post
     * @return collection
     */
    public function loadData()
    {
        $data = $this->postRepository->getAllTags();
        $data = $this->postRepository->dataTableTags($data);
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkPermission('article-show');
        return view('admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPermission('article-show');
        return view('admin.tag.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->postRepository->addTags($request);
        return redirect()->route('tag.index')->with('status', 'Create tag success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->postRepository->editTags($id);
        checkPermission('article-show');
        return view('admin.tag.index', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->postRepository->updateTags($id, $request);
        return redirect()->back()->with('status', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->deleteTags($id);
        return redirect()->route('tag.index')->with('status', 'Tag delete success!');
    }
}
