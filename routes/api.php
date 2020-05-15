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


Route::post('login', 'Api\LoginController@login');
Route::post('user-info', 'Api\LoginController@getInfo')->middleware('auth:api');
Route::post('logout', 'Api\LoginController@logout')->middleware('auth:api');


Route::middleware(['auth:api'])->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('menus', 'MenuController');
    Route::resource('settings', 'SettingController');
    Route::resource('workplaces', 'WorkplaceController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('identification-types', 'IdentificationTypeController');
    Route::resource('customers', 'CustomerController');
    Route::resource('customers.contracts', 'CustomerContractController');
    Route::get('customers/{customer}/current-contract', 'CustomerContractController@current');
    Route::resource('contracts.details', 'CustomerContractDetailController');
    Route::resource('details.orders', 'OrderController');
    Route::get('details/{detail}/last-order', 'OrderController@getLastOrder');
    Route::resource('providers', 'ProviderController');
    Route::resource('pr-types', 'ProductTypeController');
    Route::resource('products', 'ProductController');
    Route::resource('inventory-types', 'InventoryOrderTypeController')->only('index', 'show');
    Route::resource('inventory-orders', 'InventoryOrderController');
    Route::resource('inventory-orders.details', 'InventoryOrderDetailController');
    Route::resource('recipes', 'RecipeController');
    Route::resource('planifications', 'RecipePlanificationController');
    Route::resource('payment-methods', 'PaymentMethodController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('invoices.details', 'InvoiceDetailController');
});
