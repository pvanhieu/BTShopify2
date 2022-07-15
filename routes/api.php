<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Product;

use App\Http\Controllers\ShopifyController;
use App\Jobs\Queue;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/productShopifyController', [ShopifyController::class, 'getProducts']);

Route::get('/getProducts',[ShopifyController::class, 'getProducts'] , function (){
    return view('productShopifyController');
});
Route::get('/updateProducts',[ShopifyController::class, 'updateProducts']);

Route::get('/deleteProducts',[ShopifyController::class, 'deleteProducts']);


Route::get('/queue',[ShopifyController::class, 'Queue']);

Route::get('/createWebhookProduct',[ShopifyController::class, 'createWebhookProduct']);
Route::get('/updateWebhookProduct',[ShopifyController::class, 'updateWebhookProduct']);
Route::get('/deleteWebhookProduct',[ShopifyController::class, 'deleteWebhookProduct']);
Route::get('/deleteWebhook',[ShopifyController::class, 'deleteWebhook']);


Route::get('/generateCode',[ShopifyController::class, 'generateCode']);
Route::get('/getAccessToken',[ShopifyController::class, 'getAccessToken']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
