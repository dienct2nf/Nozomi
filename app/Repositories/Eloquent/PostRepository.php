<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTranslation;
use App\Repositories\PostRepositoryInterface;
use DataTables;
use Illuminate\Support\Facades\Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
class PostRepository extends BaseRepository implements PostRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;


     /**
     * @var Tag
     */
    protected $tag;

   /**
    * PostRepository constructor.
    * Tag constructor.
    *
    * @param Post $model
    */
   public function __construct(Post $model, Tag $tag)
   {
       parent::__construct($model);
       $this->tag = $tag;
   }


    /**
     * get all tags
     */
    public function getAllTags() {
        return $this->tag->all();
    }

     /**
     * get all tags array
     */
    public function getAllTagsToArray() {
        return $this->tag->pluck('title', 'id')->toArray();
    }


    /**
     * add tags record
     */
    public function addTags($request) {
        return $this->createTags($request);
    }

     /**
     * add tags record
     */
    public function editTags($id) {
        return $this->tag->find($id);
    }

     /**
     * update tags record
     */
    public function updateTags($id, $request) {
        $tag =  $this->tag->find($id);
        return $tag->update($request->all());
    }


    /**
     * add tags record
     */
    public function deleteTags($id) {
        $tags = $this->tag->find($id);
        $tags->posts()->detach();
        return $tags->delete();
    }

    /**
     * add tags record
     */
    public function dataTableTags($data) : object {
        return  Datatables::of($data)
                    ->addColumn('created_at', function ($post) {
                            return $post->created_at->format('H:i d/m/Y');
                            })
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a data-toggle="tooltip" data-placement="right" title="'.__('label.edit').'" href="'.route('tag.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }

                        $btn .= '<a data-toggle="tooltip" data-placement="right" title="'.__('label.view').'" href="/tag/'.$row->slug.'" target="_bank" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye "></i></a>';

                        if (auth()->user()->can('article-delete')) {
                            $btn .= '<form method="POST" action="'.route("tag.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button data-toggle="tooltip" data-placement="right" title="'.__('label.delete').'" class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
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
                'content'       => $request->input('content_'.$key),
                'title_seo'       => $request->input('title_seo_'.$key),
                'description_seo'       => $request->input('description_seo_'.$key)
            ];
        }
        $newArrayAtribute['created_at'] = date("Y-m-d H:i:s", strtotime($request->input('created_at')));
        $newArrayAtribute['schema'] = $request->input('schema');
        if ( $request->has('top') ) {
            $newArrayAtribute['top'] = 1;
            $newArrayAtribute['timetop_at'] = now();
        } else {
            $newArrayAtribute['top'] = 0;
        }
        $newArrayAtribute['status'] = $request->input('status');
        $newArrayAtribute['slug'] = SlugService::createSlug(Post::class, 'slug', $request->slug , ['unique' => false]);

        if (!isset($request->_method) && trim(Str::upper($request->_method)) != 'PUT') {
            $newArrayAtribute['user_id'] = $request->user()->id;
        }
        //return data
        return $newArrayAtribute;
   }

    /**
    * add category
    * @param array $post_id
    * @param array $category_id
    * @return array
    */

    public function syncCategory($post_id, $category_id): array {
        $post = $this->find($post_id);
        return $post->categories()->sync($category_id);
    }
    /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTable($data) : object {
        return  Datatables::of($data)
                    ->addColumn('img', function ($post) {
                        if (trim($post->img) == '') {
                            $url= \setting('noimage');
                        } else {
                            $url= '/uploads/'.$post->img;
                        }
                        return $url;
                        })
                    ->addColumn('created_at', function ($post) {
                        return $post->created_at->format('H:i d/m/Y');
                        })
                    ->addColumn('category', function ($post) {
                        $categories = '';
                        foreach ($post->categories as $item) {
                            $categories .= $item->title.', ';
                        }
                        return rtrim($categories, ", ");
                        })
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a href="'.route('post.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }

                        $btn .= '<a href="/'.$row->slug.'" target="_bank" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye "></i></a>';

                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<form method="POST" action="'.route("post.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'category'])
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
     * select post with status and limit
     * @param string $status
     * @param string $limit
     * @return object
     */
    public function getLimitPostWithStatus($status, $limit) : object
    {
        return $this->model->with('categories')->where('status', $status)->orderBy('timetop_at', 'DESC')->orderBy('created_at', 'DESC')->limit($limit)->get();
    }


    /**
     * select post with status and limit
     * @param string $status
     * @param string $limit
     * @return object
     */
    public function getLimitPostWithStatusAndMost($status, $limit) : object
    {
        return $this->model->with('categories')
        ->where('status', $status)
        ->orderBy('view_count', 'DESC')
        ->limit($limit)->get();
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
     * select page post
     * @param int $limit
     * @return object
     */

    public function page($limit) : object {
        return $this->model->orderBy('created_at', 'DESC')->paginate($limit);
    }

    /**
     * counter view post
     * @param int $int
     */

    public function counterPost($id) : bool {
        // lượt xem bài viết
    $key = 'post' . $id;
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
     * insert tags
     * @param array $tag
     * @param int $id
     */

    public function createTags($request) : array
    {
        $tags_array = explode(',', $request->tags);
        // create array
        $tagArray = [];
        foreach ($tags_array as $key => $tag) {
            $tags = $this->tag->create([
                'title' => $tag,
                'user_id' => $request->user()->id
            ]);
            array_push($tagArray,$tags->id);
        }
        return $tagArray;
    }

    /**
    * add category
    * @param array $request
    * @param array $id
    * @return array
    */

    public function syncTags($request, $id): bool {
        $post = $this->model->find($id);
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
            return true;
        } else {
            $post->tags()->detach();
            return false;
        }

    }

    /**
     * list sitemap post
     * @return object
     */
    public function siteMapPosts() : object {
        return $this->model->where('status', 'publish')->orderBy('updated_at', 'DESC')->get();
    }

    /**
     * list sitemap tag
     * @return object
     */
    public function siteMapTags() : object {
        return $this->tag->orderBy('updated_at', 'DESC')->get();
    }

    /**
     * tag
     * @return object
     */
    public function tagWhereSlug($slug) : object {
        return $this->tag->whereSlug($slug)->firstOrFail();
    }

     /**
     * get tag repost
     * @param int $limit
     * @return object
     */
    public function getTagLimit($limit) : object {
        return $this->tag->limit($limit)->orderBy('created_at', 'DESC')->get();
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
    public function replaceImageStyle() : bool {
        $list =  $this->model->all();
        foreach ($list as $row) {
            $post = $this->model->find($row->id);
            $post->timestamps = false;
            $text = preg_replace('/(\<img[^>]+)(style\=\"[^\"]+\")([^>]+)(>)/', '${1}${3}${4}', $post->content);
            $text = preg_replace('/(<img[^>]+src="([^\\"]+)"[^>]+\\/>)/','<div style="text-align:center"><figure class="image" style="display:inline-block">\\1<figcaption></figcaption></figure></div>', $text);
            $post->content = $text;
            $post->save();
        }
        return true;
    }

    /**
     * return all with order
     * @param int $limit
     * @return object
     */
    public function replaceLinkImage() : bool {
        $list =  $this->model->all();
        $form = 'http://xuatkhaulaodongnhat.org/';
        $to = 'http://nozomijapan.vn/';
        foreach ($list as $row) {
            $post = $this->model->find($row->id);
            $post->timestamps = false;
            $post->content = str_replace($form, $to, $post->content);
            $post->save();
        }
        return true;
    }

    public function replaceLinkImageChangerForler() : bool {
        $list =  $this->model->all();
        $form = 'http://nozomijapan.vn/storage/';
        $to = 'http://nozomijapan.vn/';
        foreach ($list as $row) {
            $post = $this->model->find($row->id);
            $post->timestamps = false;
            $post->content = str_replace($form, $to, $post->content);
            $post->save();
        }
        return true;
    }

    /**
     * return all with order
     * @param int $limit
     * @return object
     */
    public function replaceLinkImageError() : bool {
        $list =  $this->model->all();
        $form = '<p><strong><div style="text-align:center">';
        $to = '<div style="text-align:center">';
        $form1 = '</div></strong></p>';
        $to1 = '</div>';
        foreach ($list as $row) {
            $post = $this->model->find($row->id);
            $post->timestamps = false;
            $text = str_replace($form, $to, $post->content);
            $text = str_replace($form1, $to1, $text);
            $post->content = $text;
            $post->save();
        }
        return true;
    }

    /**
     * search full text
     */

    public function searchFullText($request)
    {
            if (empty($request->category_id)) {
                $data = PostTranslation::Search($request->s);
            } else {
                $data = PostTranslation::SearchCategory($request->s, $request->category_id);
            }
            return $data;
    }
}
