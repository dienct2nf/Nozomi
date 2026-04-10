<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use DataTables;
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;

    /**
     * @var category_data
     */
    public $category_data;

   /**
    * CategoryRepository constructor.
    *
    * @param Category $model
    */
   public function __construct(Category $model)
   {
       parent::__construct($model);
   }

   /**
    * attribute value form
    * @param array $request
    * @return array
    */

   public function attribute($request): array {

    $newArrayAtribute = [];

    foreach (config('translatable.language') as $key => $item) {

        $newArrayAtribute[$key] = [
            'title'       => $request->input('title_'.$key),
            'description'       => $request->input('description_'.$key),
            'title_seo'       => $request->input('title_seo_'.$key),
            'description_seo'       => $request->input('description_seo_'.$key)
        ];
    }
    $newArrayAtribute['parent_id'] = $request->input('parent_id') == 0? NULL : $request->input('parent_id');
    if (!isset($request->_method) && trim(Str::upper($request->_method)) != 'PUT') {
        $newArrayAtribute['user_id'] = $request->user()->id;
        $newArrayAtribute['slug'] = SlugService::createSlug(Category::class, 'slug', $request->slug);
    }
    //return data
    return $newArrayAtribute;
   }

   /**
    * get category by langues
    * @param $language String
    * @return array
    */
    public function listCategories($language) : object {
        $data = $this->model->with(["children" => function($query) use ($language){
            $query->withTranslation($language);
        }])
        ->withTranslation($language)
        ->get();
        return $data;
    }

    /**
    * get category by langues
    * @param $language String
    * @return array
    */
    public function listCategoriesToArray($language) : array {
        $data = $this->listCategories($language);
        $arrayData = new \stdClass();
        foreach ($data as $row) {
            $title = $row['translations'][0]['title'];
            $id = $row['translations'][0]['category_id'];
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

        /**
    * get category by langues
    * @param $language String
    * @return array
    */
    public function addNone($list, $id = null) : array {
        $list[0] = 'None';
        if ($id !== null) {
            unset($list[$id]);
        }
        return (array) $list;
    }

    /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTable($data) : object {
        return  Datatables::of($data)
                    ->addColumn('img', function ($category) {
                        if ($category->img == '') {
                            $url= \setting('noimage');
                        } else {
                            $url= '/uploads/'.$category->img;
                        }
                        return $url;
                        })
                    ->addColumn('post', function ($category) {
                        return $category->posts()->count();
                        })
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a href="'.route('category.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }

                        $btn .= '<a href="/category/'.$row->slug.'" target="_bank" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye "></i></a>';

                        if (auth()->user()->can('article-delete')) {
                            $btn .= '<form method="POST" action="'.route("category.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
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
     * select recore category_id
     * @param int $id
     */

    public function whereCategoryId($id, $limit) : object {
        $related = $this->model->whereId($id)->with(
            [
                'posts' => function ($query) use ($limit)
                    {
                        $query->orderBy('created_at', 'desc');
                        $query->orderBy('view_count', 'desc');
                        $query->limit($limit);
                    }
            ])
        ->get();
        return $related;
    }

    /**
     * select recore category_id
     * @param int $id
     */

    public function whereCategorybySlug($slug, $limit) : object {
        $slug = explode(',', $slug);
        $post = $this->model->whereIn('slug', $slug)->with(
            [
                'posts' => function ($query) use ($limit)
                    {
                        $query->orderBy('timetop_at', 'desc');
                        $query->orderBy('created_at', 'desc');
                        $query->limit($limit);
                    }
            ])
        ->firstOrFail();
        return $post;
    }

    /**
     * find slug
     * @param string $slug
     * @return object
     */

    public function findBySlugOrFail($slug) : object {
        return $this->model->whereSlug($slug)->firstOrFail();
    }

    /**
     * list sitemap tag
     * @return object
     */
    public function siteMapCategories() : object {
        return $this->model->orderBy('updated_at', 'DESC')->get();
    }

    /**
     * get list category with user and order
     * @param string $desc
     * @return object
     */
    public function getAllOrderBy($desc = 'DESC') : object {
        $data = $this->model->with(["author", "children" => function($query){
            $query->withTranslation(app()->getLocale());
        }])
        ->withTranslation(app()->getLocale())
        ->get();
        return $data;
    }


     /**
     * get list category with user and order, $limt
     * @param int $limit
     * @param string $desc
     * @return object
     */
    public function getAllOrderByLimit($limit, $desc = 'DESC') : object {
        $data = $this->model->with(["author", "children" => function($query){
            $query->withTranslation(app()->getLocale());
        }])
        ->withTranslation(app()->getLocale())
        ->limit($limit)
        ->get();
        return $data;
    }
}
