<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\Eloquent\PostRepository;

use App\Repositories\SettingRepositoryInterface;
use App\Repositories\Eloquent\SettingRepository;

use App\Repositories\MenuRepositoryInterface;
use App\Repositories\Eloquent\MenuRepository;

use App\Repositories\RoleRepositoryInterface;
use App\Repositories\Eloquent\RoleRepository;

use App\Repositories\SliderRepositoryInterface;
use App\Repositories\Eloquent\SliderRepository;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;

use App\Repositories\WorkflowRepositoryInterface;
use App\Repositories\Eloquent\WorkflowRepository;

use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\ServiceProvider;

/**
* Class RepositoryServiceProvider
* @package App\Providers
*/
class RepositoryServiceProvider extends ServiceProvider
{
   /**
    * Register services.
    *
    * @return void
    */
   public function register()
   {
       $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
       $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
       $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
       $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
       $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
       $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
       $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
       $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
       $this->app->bind(WorkflowRepositoryInterface::class, WorkflowRepository::class);
   }
}
