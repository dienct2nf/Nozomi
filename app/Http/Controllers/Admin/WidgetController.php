<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\SliderRepository;
use App\Http\Requests\Widget\WidgetRequest;

class WidgetController extends Controller
{
    /**
     * SliderRepository
     * @var sliderRepository
     */
    private $sliderRepository;

    /**
     * sliderRepository constructor.
     * @param sliderRepository
     */
    public function __construct(SliderRepository $sliderRepository) {
        $this->sliderRepository = $sliderRepository;
    }

     /**
     * show index category
     * @return collection
     */
    public function loadData(Request $request)
    {
        //var_dump($this->sliderRepository->getListWidget()); 
        $data = $this->sliderRepository->getListWidget();
        $data = $this->sliderRepository->dataTableWidget($data, $request);
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widget = [];
        checkPermission('article-create');
        return view('admin.widget.form', compact('widget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $widget = [];
        checkPermission('article-create');
        return view('admin.widget.form', compact('widget'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WidgetRequest $request)
    {
        $validated = $request->validated();
        $widget = $this->sliderRepository->addWidget($request);
        return redirect()->route('widget.edit', $widget->id)
                        ->with('status', 'Created widget successful!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPermission('article-edit');
        $text = 'Edit Widget';
        $widget = $this->sliderRepository->findWidget($id);
        return view('admin.widget.form', compact('widget', 'text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(WidgetRequest $request, $id)
    {
        $this->sliderRepository->updateWidget($request, $id);
        return redirect()->back()
                         ->with('status', 'Updated widget successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sliderRepository->deleteWidget($id);
        return redirect()->route('widget.create')->with('status', 'Deleted Widget successful!');
    }
}
