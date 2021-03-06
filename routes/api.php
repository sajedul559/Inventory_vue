<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[AuthController::class,'login']);
    Route::post('signup',[AuthController::class,'signup']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::post('me',[AuthController::class,'me']);


});

Route::apiResource('/employee',EmployeeController::class);
Route::apiResource('/supplier',SupplierController::class);
Route::apiResource('/category',CategoryController::class);
Route::apiResource('/test',TestController::class);
Route::apiResource('/product',ProductController::class);
Route::apiResource('/expense',ExpenseController::class);
Route::apiResource('/customer',CustomerController::class);


Route::post('/salary/paid/{id}',[SalaryController::class,'Paid']);
Route::Get('/salary',[SalaryController::class,'allSalary']);
Route::Get('/salary/view/{id}',[SalaryController::class,'viewSalary']);
Route::Get('/salary/edit/{id}',[SalaryController::class,'editsalary']);
Route::Post('/salary/update/{id}',[SalaryController::class,'updatesalary']);
Route::Post('/stock/update/{id}',[SalaryController::class,'updatestock']);


Route::get('/geeting/product/{id}',[PosController::class,'getProduct']);
Route::get('/addToCart/{id}',[CartController::class,'addToCart']);

Route::get('/cart/product',[CartController::class,'cartProduct']);

Route::get('/cart/remove/{id}',[CartController::class,'removeCart']);

Route::get('/cart/increment/{id}',[CartController::class,'incrementCart']);
Route::get('/cart/decrement/{id}',[CartController::class,'decrementCart']);
Route::get('/vats',[CartController::class,'vats']);

Route::get('/cart/quantity',[CartController::class,'cartQuantity']);
Route::get('/cart/subtotal',[CartController::class,'cartSubTotal']);
Route::post('/order',[PosController::class,'order']);



Route::get('/orders',[OrderController::class,'todayOrders']);
Route::get('/order/details/{id}',[OrderController::class,'orderDetails']);
Route::get('/order/order_details/{id}',[OrderController::class,'orderDetailsAll']);






