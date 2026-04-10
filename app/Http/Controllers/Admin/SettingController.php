<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\SettingRepository;
use Session;
class SettingController extends Controller
{

    /**
     * SettingRepository
     * @var settingRepository
     */
    private $settingRepository;

    /**
     * settingRepository constructor.
     * @param settingRepository
     */
    public function __construct(SettingRepository $settingRepository) {
        $this->settingRepository = $settingRepository;
    }

    /**
     * show setting form
     * @return Illuminate\Http\Response
     */

    public function index() {
        checkPermission('admin-create');
        return view('admin.setting.index');
    }

     /**
      * insert & update database table settings
      * @return Collectiom
      */

    public function store(Request $request) {
        $tab = $request->input('tab');
        Session::put('tab', $tab); //save session load tab current
        $rules = $this->settingRepository->validateSetting($request);
        $data = $this->validate($request, $rules);
        $this->settingRepository->addSetting($data);
        return redirect()->back()->with([
            'status' => 'Settings has been saved.',
            'tab' => $tab,
            ]);
    }

}
