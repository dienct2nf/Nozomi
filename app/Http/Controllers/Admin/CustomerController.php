<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Requests\Customer\CustomerContactRequest;
use App\Http\Requests\Customer\CustomerContactAddCartRequest;

class CustomerController extends Controller
{

     /**
     * CustomerRepository
     * @var customerRepository
     */
    private $customerRepository;


     /**
     * ProductRepository
     * @var productRepository
     */
    private $productRepository;

    /**
     * categoryRepository, customerRepository constructor.
     * @param customerRepository
     */
    public function __construct(
        CustomerRepository $customerRepository,
        productRepository $productRepository
        ) {
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * show index post
     * @return collection
     */
    public function loadData()
    {
        $data = $this->customerRepository->getAllOrderBy();
        $data = $this->customerRepository->dataTable($data);
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        checkPermission('article-show');
        return view('admin.customer.index');
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
    public function store(CustomerRequest $request)
    {
        // no validation
        request()->validate([
            'full_name' => 'required',
//            'email' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $customer = $this->customerRepository->addCustomer($request);
        // return redirect()->route('customer.edit', $customer->id)->with('status', 'Customer created success!');
        return 'oke';
    }


     /**
     * addCart a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCart(CustomerContactAddCartRequest $request)
    {

        $customer = $this->customerRepository->addCart($request);

        return redirect()->route('home.contact')->with('status', 'Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ sớm liên hệ lại với bạn.');
    }

    /**
     * post a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(CustomerRequest $request)
    {
        request()->validate([
            'full_name' => 'required',
//            'email' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $customer = $this->customerRepository->addCustomer($request);
        return response()->json(['code' => 1, 'msg' => 'Thành công']);

        return redirect()->route('home.contact2')->with('status', 'Cảm ơn bạn đã để lại thông tin. Chúng tôi sẽ sớm liên hệ lại với bạn.');
    }

    /**
     * post a newly contact cusstomer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addContact(CustomerContactRequest $request)
    {
        // no validation
        request()->validate([
            'full_name' => 'required',
//            'email' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $customer = $this->customerRepository->addCustomer($request);

        return response()->json(['code' => 1, 'msg' => 'Thành công']);
        return redirect()->route('home.contact')->with('status', 'Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ sớm liên hệ lại với bạn.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerRequest  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerRequest  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPermission('article-edit');
        $text = 'Cập nhật thông tin khách hàng';
        $customer = $this->customerRepository->find($id);
        $product = $this->productRepository->listProductToArray();
        return view('admin.customer.edit', compact('text', 'product', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerRequest  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        checkPermission('article-edit');
        $this->customerRepository->updateCart($request, $id);
        return back()->with('status', 'Customer update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerRequest  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        checkPermission('admin-delete');
        $this->customerRepository->deleteCustomer($id);
        return redirect()->route('customer.index')->with('status', 'Customer delete success!');
    }

    /**
     * customer export excel
     */

    public function export() {
        return $this->customerRepository->export();
    }


}
