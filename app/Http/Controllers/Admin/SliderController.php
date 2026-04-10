<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\SliderRepository;
use App\Http\Requests\Slider\SliderRequest;

class SliderController extends Controller
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
        $data = $this->sliderRepository->getChildren();
        $data = $this->sliderRepository->dataTable($data, $request);
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
        $group = $this->sliderRepository->listSliderArray();
        $slider = [];
        $text = 'Add Slider';
        return view('admin.slider.index', compact('group', 'slider', 'text'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $validated = $request->validated();
        $slider = $this->sliderRepository->addSlider($request);
        return redirect()->route('slider.edit', $slider->id)
                        ->with('status', 'Created slider successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
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
        $text = 'Edit Slider';
        $group = $this->sliderRepository->listSliderArray();
        $slider = $this->sliderRepository->find($id);
        return view('admin.slider.index', compact('group', 'slider', 'text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = $this->sliderRepository->updateSlider($request, $id);
        return redirect()->back()
                         ->with('status', 'Updated slider successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = $this->sliderRepository->delete($id);
        return redirect()->back()
                         ->with('status', 'Deleted slider successful!');
    }
}
