<?php
//
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category ;
use Illuminate\Support\Facades\Cache ;
//
//app()->bind('mostafa',function (){
//    return 'welcome' ;
//});
//
//dd(app()->make('mostafa'));
///*
//|--------------------------------------------------------------------------
//| API Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register API routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| is assigned the "api" middleware group. Enjoy building your API!
//|
//*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::get('/',function (){
//    return 'hello' ;
//});
//
//Route::get('/',function (){
//    $category =Category::find(1)->children;
//
//     dd($category);
//});
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Auth\RegisterController@action')->name('register');
    Route::post('login', 'Auth\LoginController@action')->name('login');
    Route::get('me', 'Auth\MeController@action')->name('me');


    Route::get('addresses/{address}/shipping','Address\AddressShippingController@action') ;

});

Route::resource('cart','Cart\CartController',[
    'parameters'=>[
        'cart'=>'productVariation'
    ]
]) ;


Route::resource('categories','Categories\CategoryController') ;
Route::resource('products','Products\ProductController') ;
Route::resource('addresses','Address\AddressController') ;
Route::resource('countries','Countries\CountryController') ;
Route::resource('orders','Orders\OrderController') ;
Route::resource('payment-methods','paymentMethod\PaymentMethodController') ;



