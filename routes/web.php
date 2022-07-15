<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product;
use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */
// Route::post('/createwebhook',[Product::class, 'createwebhook']);

// Route::get('/getAccessToken',[Product::class, 'getAccessToken']);

Route::get('/index',[Product::class, 'product'], function () {
    return view('products');
});
Route::get('/add_product', function () {
    return view('add_product');
});
// Route::get('/product', [Product::class, 'product']);
// Route::post('/create-products', [Product::class, 'create_products']);
// Route::get('/edit-product/{id_products}', [Product::class, 'edit_Product']);
// Route::get('/delete-product/{id_products}', [Product::class, 'delete_Product']);
// Route::post('/update-product/{id_products}', [Product::class, 'update_Product']);

Route::post('/search-product/{title}', [Product::class, 'search_Product'], function(){
    return view('search_product');
});
Route::get('/search-product', [Product::class, 'search_Product']);


Route::get('/shopify',[ShopifyController::class, 'shopify1123']);
Route::get('/getProducts', [ShopifyController::class, 'getProducts'])->name('page');
Route::get('/shopify/url',[ShopifyController::class, 'generateCode']);
Route::get('/productshopify',[ShopifyController::class, 'products']);
Route::get('/editproduct/{id}',[ShopifyController::class, 'editProducts']);
Route::post('/update-product/{id}', [ShopifyController::class, 'updateProducts']);
Route::get('/delete-product/{id}', [ShopifyController::class, 'deleteProducts']);




Route::get('/', function () {
    return view('welcome');
})->middleware(['verify.shopify'])->name('home');