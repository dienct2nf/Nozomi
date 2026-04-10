<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use DataTables;
use Image;
use MediaUploader;
use Illuminate\Support\Facades\Session;
use Storage;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;

   /**
    * ProductRepository constructor.
    *
    * @param Product $model
    */
   public function __construct(Product $model)
   {
       parent::__construct($model);
   }

    /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTable($data) : object {
        return  Datatables::of($data)
                    ->addColumn('img', function ($product) {
                        if (trim($product->img) == '') {
                            $url= \setting('noimage');
                        } else {
                            $url= '/uploads/'.$product->img;
                        }
                        return $url;
                        })
                    ->addColumn('date', function ($product) {
                        return date('d/m/Y', strtotime($product->date));
                    })
                    ->addColumn('price', function ($product) {
                        return \product_price($product->price);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a href="'.route('product.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }

                        $btn .= '<a href="/don-hang/'.$row->slug.'" target="_bank" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye "></i></a>';

                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<form method="POST" action="'.route("product.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    /**
     * add product
     * @param array $request
     * @return object
     */
    public function addProduct($request) : object
    {
        $input = $request->all();
        if ($request->has('top')) {
            $input['top'] = 1;
            $input['top_time'] = now();
        }
        $input['user_id'] =  $request->user()->id;
        $data = $this->model->create($input);
        $this->thumbProduct($request, 'product', $data->id);
        return $data;
    }

    /**
     * edit updateProduct
     * @param array $request
     * @param int $id
     * @return object
     */
    public function updateProduct($request, $id) : bool
    {
        $product = $this->model->find($id);
        $input = $request->all();
        if ($request->has('top')) {
            $input['top'] = 1;
            $input['top_time'] = now();
        }
        $data = $product->update($input);
        $this->thumbProduct($request, 'product', $id);
        return $data;
    }

    /**
     * delete product
     * @param int $id
     * @return object
     */
    public function deleteProduct($id) : bool
    {
        $data = $this->model->destroy($id);
        return $data;
    }
     /**
     * delete with file and media
     * @param int $id
     * @return object
     */
    public function deleteWithMedia($id) : bool
    {
        $this->deleteFile($id);
        return $this->model->destroy($id);
    }

    /**
     * find slug
     * @param string $slug
     * @return object
     */

    public function findBySlugfirstOrFail($slug) : object {
        return $this->model->whereSlug($slug)->firstOrFail();
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
     * counter view post
     * @param int $int
     */

    public function counterProduct($id) : bool {
        // lượt xem bài viết
    $key = 'product' . $id;
    $post = $this->model->find($id);
    if (!Session::has($key)) {
        $post->timestamps = false;
        $post->view_count = $post->view_count + 1;
        $post->save();
        Session::put($key, $id);
    }
    return true;
    }

    /**
     * list sitemap post
     * @return object
     */
    public function siteMapProducts() : object {
        return $this->model->where('status', 'publish')->orderBy('updated_at', 'DESC')->get();
    }

    /**
     * return all with order
     * @param int $limit
     * @return object
     */
    public function getAllOrderBy($desc = 'DESC') : object {
        return $this->model->with('author')->orderBy('created_at', 'DESC')->get();
    }

    /**
     * return all with order
     * @param int $limit
     * @return object
     */
    public function getLimitTop($limit = 6, $status = 'enable') : object {
        return $this->model->with('author')
        ->where('top', 1)
        ->where('status', $status)
        ->limit($limit)
        ->orderBy('date', 'DESC')
        ->get();
    }


    /**
     * select product with status and limit
     * @param string $status
     * @param string $limit
     * @return object
     */
    public function getLimitProductWithStatus($status, $limit) : object
    {
        return $this->model->where('status', $status)->orderBy('date', 'DESC')->limit($limit)->get();
    }


    /**
     * select product with status all
     * @param string $status
     * @param string $limit
     * @return object
     */
    public function getLimitProductWithStatusAll($status) : object
    {
        return $this->model->where('status', $status)->orderBy('date', 'DESC');
    }

    public function thumbProduct($request, $folder, $id): ? bool {
        // small. jpg (320 × 240 pixels)
        $data = $this->find($id);
        $filename = $data->slug.'-'.mt_rand();
        if ( isset($request->image) && !empty($request->image)) {
            $img = Storage::disk('photos')->get($request->image);
            // delete old thumb
            $this->deleteThumb($id);
            // create new thumb
            $string = Image::make($img);
            $string_encode = $string->fit(400, 270, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
            $media = MediaUploader::fromString($string_encode)
            ->toDestination('uploads', $folder.'/thumbnails/'.$this->year.'/'.$this->month)
            ->useFilename($filename.'-400-270')
            ->upload();
            $data->attachMedia($media, ['thumbnail']);
            $this->update(['img' => $media->getDiskPath()], $id);

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
        return false;

    }

    /**
    * get product
    * @return array
    */
    public function listProductToArray() : array {
        $data = $this->model->all();
        $arrayData = new \stdClass();
        $arrayData->{0} = 'Vui lòng chọn đơn hàng';
        foreach ($data as $row) {
            $title = $row->name;
            $id = $row->id;
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }
}
