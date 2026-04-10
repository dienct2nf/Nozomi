<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// group route home
// donhangxuatkhaulaodong
Route::get('/donhangxuatkhaulaodong', function() {
    return view('donhangxuatkhaulaodong');
});

// donhangchonu
Route::get('/donhangchonu', function() {
    return view('donhangchonu');
});

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/contact',
        function() {
            return redirect('/lien-he');
        })->where('query', 'contact');
    Route::get('/gioi-thieu.html',
    function() {
        return redirect('/gioi-thieu');
    })->where('query', 'gioi-thieu.html');

    Route::get('/tin-tuc/bi-seo-thi-co-di-xuat-khau-lao-dong-nhat-ban-duoc-khong-157.html',
    function() {
        return redirect('/bi-seo-thi-co-the-xuat-khau-lao-dong-nhat-ban-duoc-khong');
    });

    Route::get('/xuat-khau-lao-dong-nhat-ban',
    function() {
        return redirect('/xuat-khau-lao-dong-nhat');
    });

    // edit
    Route::get('/thu-ngo/', 'HomeController@letter')->name('home.letter');
    Route::get('/tam-nhin-su-menh/', 'HomeController@vision')->name('home.vision');
    Route::get('/doi-ngu-can-bo-nhan-vien/', 'HomeController@staff')->name('home.staff');
    Route::get('/tru-so-va-chi-nhanh/', 'HomeController@branch')->name('home.branch');

    // search
    Route::get('/search/', 'HomeController@searchFullText');

    Route::get('/lien-he', 'HomeController@contact')->name('home.contact');
    Route::get('/dang-ky-thanh-cong', 'HomeController@contact2')->name('home.contact2');
    Route::post('/load/ajax_view', 'HomeController@loadSlug')->name('home.loadSlug');

    // product
    Route::get('/don-hang', 'HomeController@productIndex')->name('product.index');
    Route::get('/don-hang/{slug}', 'HomeController@productDetail')->name('product.detail');

    // verifyDMCA
    Route::get('/dmca-validation.html', function(){
    return 'TEdLaTJ0bUM5WlNIVEthR25RNklwZz090';
    })->name('product.detail');

    // product
    Route::get('/album', 'HomeController@album')->name('album.index');
    Route::get('/album/{slug}', 'HomeController@albumDetail')->name('album.detail');

    Route::get('/tin-tuc', 'HomeController@blog')->name('blog.index');
    Route::get('/{slug}', 'HomeController@postDetail')->where('slug', '^(?!.*login|.*category|.*filemanager|.*register|.*contact|.*admin|.*password|.*tag|.*sitemap|.*clear|.*php|.*locale|.*dmca-validation.html).*$')->name('blog.detail');

    Route::get('/category', 'HomeController@category')->name('category.index');
    Route::get('/category/{slug}', 'HomeController@categoryDetail')->name('category.detail');

    Route::get('/tag/{slug}', 'HomeController@tagDetail')->name('tag.detail');
    // sitemap
    Route::get('/sitemap', 'HomeController@sitemap')->name('home.sitemap');
//     Route::get('/email', function (){
//         phpinfo();
//     });

//    Route::get('/don-hang', function () {
//        return redirect('/');
//    });
//    
//	Route::get('/don-hang/*', function () {
//		return redirect('/');
//	});
});

// fortend
Route::group(['namespace' => 'Admin', 'prefix' => 'customer'], function () {
    Route::post('post', 'CustomerController@post')->name('customer.post');
    Route::post('addcart', 'CustomerController@addCart')->name('customer.addcart');
    Route::post('contact', 'CustomerController@addContact')->name('customer.contact');
});

Route::group([
    'namespace' => 'Admin\Workflow',
    'as' => 'work.',
    'prefix' => 'admin/work'
], function () {
    Route::get('worklist/todo/list', 'WorklistController@todoList')->name('worklist.todoList');
    Route::get('department/showlist/{id}', 'WorklistController@detailDepartment')->name('worklist.detailDepartment');
});
//login
Auth::routes();

// language
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

// language
Route::get('email', function (){
    phpinfo();
});
        

// php info
Route::get('php', function() {

});

// clear cache
Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return redirect()->home();
    return "Cleared!";
 });
