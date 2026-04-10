<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\CustomerRepository;
use App\Http\Requests\Album\AlbumRequest;

class AlbumController extends Controller
{
     /**
     * CustomerRepository
     * @var customerRepository
     */
    private $customerRepository;

    /**
     * categoryRepository, customerRepository constructor.
     * @param customerRepository
     */
    public function __construct(
        CustomerRepository $customerRepository
        ) {
        $this->customerRepository = $customerRepository;
    }

     /**
     * show index post
     * @return collection
     */
    public function loadData()
    {
        $data = $this->customerRepository->getAllAlbumOrderBy();
        $data = $this->customerRepository->dataTableAlbum($data);
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
        return view('admin.album.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPermission('article-create');
        $album = [];
        return view('admin.album.create', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $album = $this->customerRepository->addAlbum($request);
        return redirect()->route('album.edit', $album->id)->with('status', 'Album created success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumRequest $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPermission('article-edit');
        $album = $this->customerRepository->findAlbum($id);
        return view('admin.album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->customerRepository->updateAlbum($request, $id);
        return back()->with('status', 'Album update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->customerRepository->deleteAlbum($id);
        return redirect()->route('album.index')->with('status', 'Album delete success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        $this->customerRepository->deleteImage($id);
        return true;
    }
}
