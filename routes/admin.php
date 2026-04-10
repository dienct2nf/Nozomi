<?php
// admin route
use Illuminate\Support\Facades\Route;

/**
    Admin web routes
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/media', 'AdminController@media')->name('media.index');
    Route::get('/file', 'AdminController@file')->name('media.file');
    // category
    Route::resource('category', 'CategoryController');
    Route::get('category/load/data', 'CategoryController@loadData')->name('category.loadData');

    // tags
    Route::resource('tag', 'TagController');
    Route::get('tag/load/data', 'TagController@loadData')->name('tag.loadData');

    // post
    Route::resource('post', 'PostController');
    Route::get('post/load/data', 'PostController@loadData')->name('post.loadData');
    Route::get('post/load/fix', 'PostController@fixImage')->name('post.fixImage');
    // setting
    Route::resource('setting', 'SettingController');
    // role
    Route::resource('role','RoleController');
    Route::get('role/load/data', 'RoleController@loadData')->name('role.loadData');
    // permission
    Route::resource('permission','PermissionController');
    Route::get('permisson/load/data', 'PermissionController@loadData')->name('permission.loadData');
    // user
    Route::resource('user','UserController');
    Route::get('personal','UserController@editPersonal')->name('user.me');
    Route::put('personal','UserController@updatePersonal')->name('user.personal');
    Route::get('user/load/data', 'UserController@loadData')->name('user.loadData');
    // slider
    Route::resource('slider','SliderController');
    Route::get('slider/load/data', 'SliderController@loadData')->name('slider.loadData');
    // product
    Route::resource('product','ProductController');
    Route::get('product/load/data', 'ProductController@loadData')->name('product.loadData');

    // album
    Route::resource('album','AlbumController');
    Route::get('album/load/data', 'AlbumController@loadData')->name('album.loadData');
    Route::delete('album/delete/{id}', 'AlbumController@deleteImage')->name('album.delete.image');

    // album
    Route::resource('widget','WidgetController');
    Route::get('widget/load/data', 'WidgetController@loadData')->name('widget.loadData');

    // customer
    Route::resource('customer','CustomerController');
    Route::get('customer/export/product', 'CustomerController@export')->name('customer.export');
    Route::get('customer/load/data', 'CustomerController@loadData')->name('customer.loadData');

    Route::group(['prefix' => 'menu'], function () {
        // Menu
        Route::resource('/','MenuController');
        Route::post('deleteitemmenu', 'MenuController@deleteItemMenu')->name('menu.deleteitemmenu');
        Route::post('addcustommenu', 'MenuController@addCumstomMenu')->name('menu.addcustommenu');
        Route::post('deletemenug', 'MenuController@deleteMenu')->name('menu.deletemenug');
        Route::post('createnewmenu', 'MenuController@createNewMenu')->name('menu.createnewmenu');
        Route::post('generatemenucontrol', 'MenuController@generateMenuControl')->name('menu.generatemenucontrol');
        Route::post('updateitem', 'MenuController@updateItem')->name('menu.updateitem');
    });

    // workflow
    Route::group([
        'namespace' => 'Workflow',
        'as' => 'work.',
        'prefix' => 'work'
    ], function () {
        Route::resource('department', 'DepartmentController');
        Route::get('department/load/data', 'DepartmentController@loadData')->name('department.loadData');
        Route::resource('worklist', 'WorklistController');
        Route::post('worklist/store_multiple', 'WorklistController@storeMultiple')->name('worklist.store_multiple');
        Route::get('worklist/getjson/{id}', 'WorklistController@getJson')->name('worklist.getJsonByID');
        Route::get('worklist/load/data', 'WorklistController@loadData')->name('worklist.loadData');
        Route::delete('/worklist/delete/{id}', 'WorklistController@ajaxDelete')->name('worklist.ajaxDelete');
    });

});


