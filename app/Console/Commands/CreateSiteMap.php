<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description'; 

    /**
     * Create a new command instance.
     *
     * @return void
     */

     /**
     * var
     * @var PostRepository
     */
    private $postRepository;
    
    private $productRepository;

    /**
     * var
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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

    }
}
