<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Http\Requests\Product\ProductRequest;

class ProductController extends Controller
{

     /**
     * ProductRepository
     * @var productRepository
     */
    private $productRepository;

    /**
     * categoryRepository, productRepository constructor.
     * @param productRepository
     */
    public function __construct(
        ProductRepository $productRepository
        ) {
        $this->productRepository = $productRepository;
    }

    /**
     * show index post
     * @return collection
     */
    public function loadData()
    {
        $data = $this->productRepository->getAllOrderBy();
        $data = $this->productRepository->dataTable($data);
        return $data;
    }

    /**
     *  show all product
     * @return view
     */
    public function index() {
        checkPermission('article-show');
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPermission('article-create');
        $product = [];
        return view('admin.product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->addProduct($request);
        return redirect()->route('product.edit', $product->id)->with('status', 'Product created success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPermission('article-edit');
        $product = $this->productRepository->find($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->productRepository->updateProduct($request, $id);
        return back()->with('status', 'Product update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->deleteWithMedia($id);
        return redirect()->route('product.index')->with('status', 'Product delete success!');
    }
}
