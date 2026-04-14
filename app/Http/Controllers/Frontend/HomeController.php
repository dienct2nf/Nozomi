<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * var
     * @var PostRepository
     */
    private $postRepository;

    /**
     * var
     * @var CategoryRepository
     */
    private $categoryRepository;

     /**
     * var
     * @var ProductRepository
     */
    private $productRepository;

     /**
     * var
     * @var CustomerRepository
     */
    private $customerRepository;


    /**
     * categoryRepository constructor.
     * @param categoryRepository
     */
    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        CustomerRepository $customerRepository
        )
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listPostCamNang = $this->categoryRepository->whereCategorybySlug('cam-nang, goc-chia-se', 6); //slug
        $listPostTinTuc = $this->categoryRepository->whereCategorybySlug('tin-tuc, hoi-dap', 6); //slug
        $listCategory = $this->categoryRepository->getAllOrderByLimit(4); //limit 4
        $listProduct = $this->productRepository->getLimitProductWithStatus('enable', 6);
        $album = $this->customerRepository->loadAlbumAll();
        $topProduct = $this->productRepository->getLimitTop();
        return view('frontend.home', compact('listProduct', 'topProduct', 'listCategory', 'album', 'listPostCamNang', 'listPostTinTuc'));
    }

    /**
     * Show detail blog
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postDetail($slug)
    {
        $postDetail = $this->postRepository->findBySlugOrFail($slug);
        $this->postRepository->counterPost($postDetail->id);
        $related = $this->categoryRepository->whereCategoryId($postDetail->categories->first()->id, 5);
        $related = $related[0]->posts;
        $category = $this->categoryRepository->all(); //limit 3
        $topProduct = $this->productRepository->getLimitTop();
        return view('frontend.blog.detail', compact('postDetail', 'related', 'category', 'topProduct'));
    }

     /**
     * Show contact
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('frontend.contacts.index');
    }

    public function contact2()
    {
        return view('frontend.contacts.index2');
    }

    public function letter()
    {
        return view('frontend.contacts.open_letter');
    }


    public function vision()
    {
        return view('frontend.contacts.vision');
    }

    public function staff()
    {
        return view('frontend.contacts.staff');
    }

    public function legal()
    {
        return view('frontend.contacts.legal');
    }

    public function branch()
    {
        return view('frontend.contacts.branch');
    }

    /**
     * Show blog
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blog()
    {
        $post = $this->postRepository->page(12); //limit
        $category = $this->categoryRepository->all(); //limit
        return view('frontend.blog.index', compact('post', 'category'));
    }

    /**
     * Show category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category()
    {
        $post = $this->postRepository->page(12); //limit 12
        $category = $this->categoryRepository->all(); //limit 3
        $tags = $this->postRepository->getTagLimit(5); //limit 5
        return view('frontend.category.index', compact('post', 'category', 'tags'));
    }

    /**
     * Show category detail
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categoryDetail($slug)
    {
        $post = $this->postRepository->page(5); //limit 5
        $tags = $this->postRepository->getTagLimit(5); //limit 5
        $categoryWithPost = $this->categoryRepository->findBySlugOrFail($slug); //limit 3
        $category = $this->categoryRepository->all(); //limit 3
        return view('frontend.category.detail', compact('post', 'category', 'categoryWithPost', 'tags'));
    }


    /**
     * Show product detail
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productDetail($slug)
    {
        $post = $this->postRepository->page(5); //limit 5
        $product = $this->productRepository->findBySlugfirstOrFail($slug); //limit 3
        $category = $this->categoryRepository->all(); //limit 3
        $this->productRepository->counterProduct($product->id);
        $listProduct = $this->productRepository->getLimitProductWithStatus('enable', 6);
        $topProduct = $this->productRepository->getLimitTop(4);
        return view('frontend.product.detail', compact('post', 'listProduct', 'product', 'topProduct'));
    }

    /**
     * Show product detail
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productIndex()
    {
        $listProduct = $this->productRepository->getLimitProductWithStatusAll('enable');
        return view('frontend.product.index', compact('listProduct'));
    }

    /**
     * Show album detail
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function albumDetail($slug)
    {
        $album = $this->customerRepository->findBySlugOrFail($slug); // get all.
        return view('frontend.album.detail', compact('album'));
    }

    /**
     * Show tag detail
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tagDetail($slug)
    {
        $post = $this->postRepository->page(5); //limit 5
        $tags = $this->postRepository->getTagLimit(5); //limit 5
        $tag = $this->postRepository->tagWhereSlug($slug);
        $category = $this->categoryRepository->all(); //limit 5
        return view('frontend.tag.detail', compact('tag', 'category', 'post', 'tags'));
    }

    /**
     * Show tag detail
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function loadSlug(Request $request)
    {
        $slug = $request->view;
        if ($slug == 'block-moi-nhat') {
            $post = $this->postRepository->getLimitPostWithStatus('publish', 10);
        } else if ($slug == 'block-noi-bat') {
            $post = $this->postRepository->getLimitPostWithStatusAndMost('publish', 10);
        } else {
            $post = $this->categoryRepository->findBySlugOrFail($slug); //limit 5
            $post = $post->posts()->orderBy('timetop_at', 'DESC')->orderBy('created_at', 'DESC')->limit(10)->get();
        }
        return view('frontend.load.index', compact('post'));
    }

    /**
     * search full text
     * @param string $text
     * Return object
     */

    public function searchFullText(Request $request)
    {
        $category = $this->categoryRepository->all(); //limit 5
        $key = $request->s;
        $post = $this->postRepository->searchFullText($request);
        $listPost = $this->postRepository->getLimitPostWithStatus('publish', 6);
        $tags = $this->postRepository->getTagLimit(5); //limit 5
        return view('frontend.tag.search', compact('category', 'post', 'key', 'listPost', 'tags'));
    }

    /**
     * create sitemap
     */

    public function sitemap() {
        $sitemap_posts = App::make("sitemap");

        // add items
        $blogs = $this->postRepository->siteMapPosts();
        $sitemap_posts->add(URL::to('/'), date('Y-m-d H:i:s'), '1.0', 'daily');
        $sitemap_posts->add(URL::to('/tin-tuc'), date('Y-m-d H:i:s'), '0.9', 'weekly');
        foreach ($blogs as $post)
        {
            preg_match_all('@src="([^"]+)"@', $post->text, $match);
            $src = array_pop($match);
            $images = array();
            foreach ($src as $key => $value) {
                $images[] = array(
                    'url' => $value,
                    'title' => $post->title,
                    'caption' => $post->title
                );
            }
            $sitemap_posts->add(URL::to('/').'/'.$post->slug, $post->created_at, '0.9', 'daily', $images);
        }

        // create file sitemap-posts.xml in your public folder (format, filename)
        $sitemap_posts->store('xml','sitemap-posts');
        // create sitemap
        $sitemap_product = App::make("sitemap");
        // add items
        $sitemap_product->add(URL::to('/don-hang/'), date('Y-m-d H:i:s'), '0.9', 'weekly');
        $products = $this->productRepository->all();
        foreach ($products as $product)
        {
            $images = array();
            $images[] = array(
                'url' => URL::to('uploads').'/'.$product->img,
                'title' => $product->title,
                'caption' => $product->title
            );
            $sitemap_product->add(URL::to('don-hang').'/'.$product->slug, $product->created_at, '0.9', 'weekly', $images);
        }
        // create file sitemap-posts.xml in your public folder (format, filename)
        $sitemap_product->store('xml','sitemap-products');

        // create sitemap
        $sitemap_tags = App::make("sitemap");

        // add items
        $tags = $this->postRepository->siteMapTags();

        foreach ($tags as $tag)
        {
            $sitemap_tags->add(URL::to('tag').'/'.$tag->slug, $tag->created_at, '0.8', 'daily');
        }
        // create file sitemap-tags.xml in your public folder (format, filename)
        $sitemap_tags->store('xml','sitemap-tags');

        // create sitemap index
        $sitemap = App::make("sitemap");

        // add sitemaps (loc, lastmod (optional))
        $sitemap->addSitemap('/sitemap-products.xml', date('Y-m-d H:i:s'));
        $sitemap->addSitemap('/sitemap-posts.xml', date('Y-m-d H:i:s'));
        $sitemap->addSitemap('/sitemap-categories.xml', date('Y-m-d H:i:s'));
        // $sitemap->addSitemap('/sitemap-tags.xml', date('Y-m-d H:i:s'));

        // create file sitemap.xml in your public folder (format, filename)
        $sitemap->store('sitemapindex','sitemap');
        File::copy(base_path('public/sitemap.xml'),base_path('sitemap.xml'));
        return 'Tạo thành công <a href="'.url('/sitemap.xml').'">Sitemap</a>';

        }
}
