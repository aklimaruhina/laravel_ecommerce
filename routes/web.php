<?php

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

Route::get('/', 'Frontend\PagesController@index')->name('index');

Route::group(['prefix' => 'products'], function(){
	Route::get('/', 'Frontend\ProductController@products')->name('products');
	Route::get('/{slug}', 'Frontend\ProductController@show')->name('show_product');
	Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');
	Route::get('/category/{id}', 'Frontend\CategoriesController@show')->name('categories.show');

});

//Cart Routes 
Route::group(['prefix' => 'carts'], function(){
	Route::get('/', 'CartController@index')->name('index');
	Route::post('/store', 'CartController@store')->name('carts.store');
	Route::post('/update/{id}', 'CartController@update')->name('carts.update');
	Route::post('/delete/{id}', 'CartController@destroy')->name('carts.delete');
});


Route::prefix('admin')->group(function () {
	Route::get('/', 'Backend\PagesController@index')->name('admin.index');
    Route::group(['prefix' => '/product'], function(){
	    Route::get('/createproduct', 'Backend\ProductsController@createproduct')->name('createproduct');
	    Route::get('/manage', 'Backend\ProductsController@manage_product')->name('manageproduct'); // manage -> ressource file name, name route name in link
	    Route::get('/editproduct/{id}', 'Backend\ProductsController@edit_product')->name('editproduct');
	    Route::post('/createproduct', 'Backend\ProductsController@store_product')->name('store_product');
	    Route::post('/editproduct/{id}', 'Backend\ProductsController@update_product')->name('admin.product.update');
	    Route::post('/delete/{id}', 'Backend\ProductsController@delete_product')->name('deleteproduct');

	});

	Route::group(['prefix' => '/category'], function(){
	    Route::get('/createcategory', 'Backend\CategoriesController@create_category')->name('createcategory');
	    Route::get('/manage', 'Backend\CategoriesController@manage_category')->name('managecategory'); // manage -> ressource file name, name route name in link
	    Route::get('/editcategory/{id}', 'Backend\CategoriesController@edit_category')->name('editcategory');
	    Route::post('/createcategory', 'Backend\CategoriesController@store_category')->name('store_category');
	    Route::post('/editcategory/{id}', 'Backend\CategoriesController@update_category')->name('updatecategory');
	    Route::post('/delete/{id}', 'Backend\CategoriesController@delete_category')->name('deletecategory');

	});
	Route::group(['prefix' => '/brand'], function(){
	    Route::get('/createbrand', 'Backend\BrandsController@create_brand')->name('createbrand');
	    Route::get('/manage', 'Backend\BrandsController@manage_brand')->name('managebrand'); // manage -> ressource file name, name route name in link
	    Route::get('/editbrand/{id}', 'Backend\BrandsController@edit_brand')->name('editbrand');
	    Route::post('/createbrand', 'Backend\BrandsController@store_brand')->name('store_brand');
	    Route::post('/editbrand/{id}', 'Backend\BrandsController@update_brand')->name('updatebrand');
	    Route::post('/deletebrand/{id}', 'Backend\BrandsController@delete_brand')->name('admin.brand.delete');

	});
	// Backend Division Routes Controller
	Route::group(['prefix' => '/divisions'], function(){
		Route::get('/manage', 'Backend\DivisionController@index')->name('admin.divisions');
		Route::get('/create', 'Backend\DivisionController@create')->name('admin.divisions.create');
		Route::get('/edit/{id}', 'Backend\DivisionController@edit_brand')->name('admin.divisions.edit');
		
		// Add Brands from CreateProduct Page
		Route::post('/store', 'Backend\DivisionController@store')->name('admin.divisions.store');
		Route::post('/edit/{id}', 'Backend\DivisionController@update')->name('admin.divisions.update');
		Route::post('/delete/{id}', 'Backend\DivisionController@delete')->name('admin.divisions.delete');
	});


	// Backend District Routes Controller
	Route::group(['prefix' => '/districts'], function(){
		Route::get('/manage', 'Backend\DistrictController@index')->name('admin.districts');
		Route::get('/create', 'Backend\DistrictController@create')->name('admin.districts.create');
		Route::get('/edit/{id}', 'Backend\DistrictController@edit_brand')->name('admin.districts.edit');
		
		// Add Brands from CreateProduct Page
		Route::post('/store', 'Backend\DistrictController@store')->name('admin.districts.store');
		Route::post('/edit/{id}', 'Backend\DistrictController@update')->name('admin.districts.update');
		Route::post('/delete/{id}', 'Backend\DistrictController@delete')->name('admin.districts.delete');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
