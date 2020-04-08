<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('user-info', 'Api\LoginController@getInfo')->middleware('auth:api');
Route::post('login', 'Api\LoginController@login');


Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('settings', 'SettingController');
Route::resource('workplaces', 'WorkplaceController');
Route::resource('employees','EmployeeController');
Route::resource('identification-types','IdentificationTypeController');
Route::resource('customers','CustomerController');
Route::resource('customers.contracts','CustomerContractController');
Route::get('customers/{customer}/current-contract','CustomerContractController@current');
Route::resource('contracts.details','CustomerContractDetailController');
Route::resource('details.orders', 'OrderController');
Route::get('details/{detail}/last-order','OrderController@getLastOrder');
Route::resource('providers', 'ProviderController');
Route::resource('pr-types', 'ProductTypeController');
Route::resource('products', 'ProductController');
Route::resource('inventory-types', 'InventoryOrderTypeController')->only('index','show');
Route::resource('inventory-orders', 'InventoryOrderController');
