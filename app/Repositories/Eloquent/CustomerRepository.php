<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderProduct;
use App\Models\Product;
use App\Models\Album;
use App\Repositories\CustomerRepositoryInterface;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Notifications\Customer\CreateCustomer;
use Illuminate\Support\Facades\Notification;;
use Storage;
use Image;
use MediaUploader;
use Plank\Mediable\Media;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;

     /**
     * @var CustomerOrder
     */
    protected $order;

     /**
     * @var Product
     */
    protected $product;

     /**
     * @var CustomerOrderProduct
     */
    protected $orderproduct;

    /**
     * @var Album
     */
    protected $album;

     /**
     * @var User
     */
    protected $user;

   /**
    * CustomerRepository constructor.
    *
    * @param Customer $model
    */
   public function __construct(
       Customer $model,
       CustomerOrder $order,
       Product $product,
       CustomerOrderProduct $orderproduct,
       Album $album,
       User $user
       )
   {
       parent::__construct($model);
       $this->order = $order;
       $this->product = $product;
       $this->orderproduct = $orderproduct;
       $this->album = $album;
       $this->user = $user;
   }

    /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTable($data) : object {
        return  Datatables::of($data)
                    ->addColumn('sex', function ($customer) {
                            return config('custom.sex')[$customer->sex];
                        })
                    ->addColumn('birth_day', function ($customer) {
                        return date('d/m/Y', strtotime($customer->birth_day));
                        })
                    ->addColumn('donhang', function ($customer) {
                        if(isset($customer->order->first()->products)) {
                            $name = $customer->order->first()->products->first()->name ?? '';
                            return isset($customer->order->first()->products) ? '<a target="_bank" data-toggle="tooltip" data-placement="bottom" title="' .$name . '"
                            href="/don-hang/' . ($customer->order->first()->products->first()->slug ?? '') . '">' . $name . '</a>'
                                : 'Không có';
                        }else{
                            return 'Không có dữ liệu';
                        }
                        })
                    ->addColumn('created_at', function ($customer) {
                        return $customer->created_at->format('H:i d/m/Y');
                        })
                    ->addColumn('status', function ($customer) {
                        return isset($customer->order->first()->status) ? config('custom.status_order')[$customer->order->first()->status] : 'Không tồn tại';
                        })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a data-toggle="tooltip" data-placement="right" title="'.__('label.edit').'" href="'.route('customer.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<form method="POST" action="'.route("customer.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button data-toggle="tooltip" data-placement="right" title="'.__('label.delete').'" class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'donhang'])
                    ->make(true);
    }

    /**
     * add customer
     * @param array $request
     * @return object
     */
    public function addCustomer($request) : object
    {
        $input = $request->all();
        $input['metadata'] = json_encode(['header' => $_SERVER]);
        $data = $this->model->create($input);
        $users = $this->user->all();

        Notification::send($users, new CreateCustomer($data));
        return $data;
    }

    /**
     * edit updateCustomer
     * @param array $request
     * @param int $id
     * @return object
     */
    public function updateCustomer($request, $id) : bool
    {
        $customer = $this->model->find($id);
        $data = $customer->update($request->all());
        return $data;
    }

    /**
     * delete customer
     * @param int $id
     * @return object
     */
    public function deleteCustomer($id) : bool
    {
        $data = $this->model->destroy($id);
        return $data;
    }

     /**
     * select page post
     * @param int $limit
     * @return object
     */

    public function page($limit) : object {
        return $this->model->paginate($limit);
    }

    /**
     * return all with order
     * @param int $limit
     * @return object
     */
    public function getAllOrderBy($desc = 'DESC') : object {
        return $this->model->with(['order' => function($q) use ($desc) {
            return $q->with('products');
        }])->orderBy('created_at', 'DESC')->get();
    }

    /**
     * add customer and cart
     * @param array $request
     * @return bool
     */
    public function addCart($request) : bool
    {
        DB::transaction(function() use ($request) {
            $input = $request->all();
            $data = $this->model->create($input);
            $order = $this->order->create([
                'customer_id' => $data->id,
                'status' => 'pending'
            ]);
            $product = $this->product->find($request->product_id);
            $this->orderproduct->create([
                'order_id' => $order->id,
                'quantity' => 1,
                'price' => $product->price,
                'product_id' => $product->id,
            ]);
            $users = $this->user->all();

            $c = new CreateCustomer($data);

            Notification::send($users, $c);

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                //Server settings
                //         $this->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'email-smtp.us-east-1.amazonaws.com';                    // Set the SMTP server to send through
                //         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'AKIAZNUBEWD4CAYDRPWS';                     // SMTP username
                $mail->Password   = 'BIyrZNcNL0CeD6xbz0jQINCyzWd8yej6P//7BbS6axpq';                               // SMTP password
                $mail->SMTPSecure = 'tls'; //\PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Debugoutput = 'html';
                $mail->SMTPAutoTLS = FALSE;


                $mail->SMTPAuth = true;
                $mail->isHTML(true);

                //Recipients
                $mail->setFrom('no-reply.aws@nozomijapan.vn', 'Nozomijapan');
                $mail->addAddress('zinzinx8@gmail.com', 'Trường Nozomi');     // Add a recipient
                //         $mail->addAddress('ellen@example.com');               // Name is optional
                //         $mail->addReplyTo('info@example.com', 'Information');
                //         $mail->addCC('cc@example.com');
                //         $mail->addBCC('bcc@example.com');

                // Attachments
                //         $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //         $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Thông tin liên hệ từ Nozomijapan';
                $mail->Body    = '<p><b>Thông tin khách hàng</b></p>
<p>Họ tên: '.$data->full_name.'</p>
<p>Ngày sinh: '.$data->birth_day.'</p>
<p>Giới tính: '.(isset($data->sex) ? $data->sex : '-').'</p>
<p>SĐT: '.$data->phone.'</p>
<p>Địa chỉ: '.$data->address.'</p>

<hr>
<p><b>Thông tin đơn hàng</b>: '.(isset($product->name) ? $product->name : '').'</p>
<hr>
<p>IP khách: '.(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '-').'</p>
';
                //             $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                //         $mail->smtpConnect([
                //             'ssl' => [
                //                 'verify_peer' => false,
                //                 'verify_peer_name' => false,
                //                 'allow_self_signed' => true
                //             ]
                //         ]);

                //$mail->send();

                return redirect()->route('home.contact')->with('status', 'Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ sớm liên hệ lại với bạn.');
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                echo "Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ sớm liên hệ lại với bạn...!";
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }

            return true;
        });
        return false;
    }

    /**
     * update cart
     * @param array $request
     * @return bool
     */
    public function updateCart($request, $id) : bool
    {
        DB::transaction(function() use ($request, $id) {
            $input = $request->all();
            $user = $this->model->find($id);
            $user->update($input);
            $product = $this->product->find($request->product_id);
            if ( !is_null($user->order->first() )) {
                $order = $this->order->find($user->order->first()->id);
                $order->delete();
                $order->products()->delete();
            }
            $order = $this->order->create([
                'customer_id' => $id,
                'status' => $request->status
            ]);
            $this->orderproduct->create([
                'order_id' => $order->id,
                'quantity' => 1,
                'price' => $product->price,
                'product_id' => $product->id,
            ]);

            return true;
        });
        return false;
    }

     /**
     * add album
     * @param array $request
     * @return object
     */
    public function addAlbum($request) : object
    {
        $input = $request->all();
        $input['user_id'] =  $request->user()->id;
        $data = $this->album->create($input);
        $this->thumbAlbum($request, 'albums', $data->id);
        $this->makeImage($request, $data->id);
        return $data;
    }

     /**
     * add album
     * @param array $request
     * @return object
     */
    public function updateAlbum($request, $id) : object
    {
        $input = $request->all();
        $album = $this->album->find($id);
        $data = $album->update($input);
        $this->thumbAlbum($request, 'albums', $album->id);
        $this->makeImage($request, $album->id);
        return $album;
    }
    /**
     * thumb album create
     * @param array $request
     * @param string $folder
     * @param int $id
     * @return bool
     */
    public function thumbAlbum($request, $folder, $id): ? bool {
        // small. jpg (320 × 240 pixels)
        $data = $this->album->find($id);
        $filename = $data->slug.'-'.mt_rand();
        if ( isset($request->image) && !empty($request->image)) {
            $img = Storage::disk('photos')->get($request->image);
             // delete old thumb
             $this->deleteThumb($id);
            // create new thumb
            $string = Image::make($img);
            $string_encode = $string->fit(600, 390, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
            $media = MediaUploader::fromString($string_encode)
            ->toDestination('uploads', $folder.'/thumbnails/'.$this->year.'/'.$this->month)
            ->useFilename($filename.'-600-390')
            ->upload();
            $data->attachMedia($media, ['thumbnail']);
            $data->update(['img' => $media->getDiskPath()]);

            $string_encode->destroy();
            return true;
        }
        return false;

    }

    /**
     * thumb album create
     * @param array $request
     * @param string $folder
     * @param int $id
     * @return bool
     */

    public function createthumbAlbum($file, $folder, $id): ? bool {
        // small. jpg (320 × 240 pixels)
        $data = $this->album->find($id);
        $filename = $data->slug.'-'.mt_rand();
        $img = Storage::disk('photos')->get($file);
        // create new thumb
        $string = Image::make($img);

        // original
        $string_encode = $string->resize($string->width(), $string->height(), function ($constraint) {
            $constraint->aspectRatio();
        })
        ->encode('jpg');
        $media = MediaUploader::fromString($string_encode)
        ->toDestination('uploads', $folder.'/original/'.$this->year.'/'.$this->month)
        ->useFilename($filename)
        ->upload();

        $data->attachMedia($media, ['original']);

        $string_encode->destroy();
        return true;

    }

    /**
     * foreach create album
     * @param array $request
     * @param int $id
     */
    public function makeImage($request, $id): bool {
        if ( isset($request->album) && !empty($request->album)) {
            $array  =  explode('|||', $request->album);

            foreach ($array as $val) {
                $this->createthumbAlbum($val, 'albums', $id);
            }
            return true;
        }
        return false;
    }

    /**
     * load album
     */

    public function loadAlbumAll() : object {
        return $this->album->orderBy('created_at', 'DESC')->get();
    }

     /**
    * @param int $id
    * @return bool
    */
    public function deleteThumb($id): ? bool {
        $data = $this->album->find($id);
        $data = $data->loadMedia(['thumbnail', 'original']);
        $arrayFiles = [];
        foreach ($data->media as $item) {
            $image_path ="$item->disk/$item->directory/$item->filename.$item->extension";
            array_push($arrayFiles, $image_path);
        }
        return Storage::disk('photos')->delete($arrayFiles);
    }

    /**
     * find id album
     * @param int $id;
     */

    public function findAlbum($id) :  object {
        return $this->album->find($id);
    }

    /**
     * delete id image
     * @param int $id
     */

    public function deleteImage($id) :  bool {
        $media = Media::find($id);
        Storage::disk('photos')->delete($media->getDiskPath());
        return $media->delete();
    }
     /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTableAlbum($data) : object {
        return  Datatables::of($data)
                    ->addColumn('img', function ($product) {
                        if (trim($product->img) == '') {
                            $url= \setting('noimage');
                        } else {
                            $url= '/uploads/'.$product->img;
                        }
                        return $url;
                        })
                    ->addColumn('soluong', function ($customer) {
                            return $customer->loadMedia(['original'])->media->count();
                        })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a data-toggle="tooltip" data-placement="right" title="'.__('label.edit').'" href="'.route('album.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<form method="POST" action="'.route("album.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button data-toggle="tooltip" data-placement="right" title="'.__('label.delete').'" class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'donhang'])
                    ->make(true);
    }


    /**
     * return all with order
     * @param int $limit
     * @return object
     */
    public function getAllAlbumOrderBy($desc = 'DESC') : object {
        return $this->album->with('author')->orderBy('created_at', 'DESC')->get();
    }

     /**
     * delete customer
     * @param int $id
     * @return object
     */
    public function deleteAlbum($id) : bool
    {
        $this->deleteThumbAlbum($id);
        $data = $this->album->destroy($id);
        return $data;
    }

     /**
    * @param int $id
    * @return bool
    */
    public function deleteThumbAlbum($id): ? bool {
        $data = $this->album->find($id);
        $data = $data->loadMedia(['thumbnail', 'original']);
        $arrayFiles = [];
        foreach ($data->media as $item) {
            $image_path ="$item->disk/$item->directory/$item->filename.$item->extension";
            array_push($arrayFiles, $image_path);
        }
        return Storage::disk('photos')->delete($arrayFiles);
    }

    /**
     * find slug
     * @param string $slug
     * @return object
     */

    public function findBySlugOrFail($slug) : object {
        return $this->album->whereSlug($slug)->firstOrFail();
    }

    /**
     * export file excel customer
     */

    public function export()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx-' . date('H-i-d-m-Y') . '.xlsx');
    }
}
