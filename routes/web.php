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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin/menu', 'MenuController@adminIndex')->name('admin.menu.index');
Route::get('/admin/menu/create', 'MenuController@adminCreate')->name('admin.menu.create');
Route::post('/admin/menu', 'MenuController@adminStore')->name('admin.menu.store');
Route::patch('/admin/menu/deactivate/{id}', 'MenuController@adminDeactivateMenu')->name('admin.menu.deactivate');
Route::patch('/admin/menu/activate/{id}', 'MenuController@adminActivateMenu')->name('admin.menu.activate');
Route::get('/admin/menu/edit/{id}', 'MenuController@adminEdit')->name('admin.menu.edit');
Route::patch('/admin/menu/edit/{id}', 'MenuController@adminUpdate')->name('admin.menu.update');

Route::get('/admin/food-type', 'FoodTypeController@adminIndex')->name('admin.food-type.index');
Route::get('/admin/food-type/create', 'FoodTypeController@adminCreate')->name('admin.food-type.create');
Route::get('/admin/food-type/edit/{id}', 'FoodTypeController@adminEdit')->name('admin.food-type.edit');
Route::post('/admin/food-type', 'FoodTypeController@adminStore')->name('admin.food-type.store');
Route::patch('/admin/food-type/edit/{id}', 'FoodTypeController@adminUpdate')->name('admin.food-type.update');

Route::get('/admin/employee', 'EmployeeController@adminIndex')->name('admin.employee.index');
Route::get('/admin/employee/create', 'EmployeeController@adminCreate')->name('admin.employee.create');
Route::post('/admin/employee', 'EmployeeController@adminStore')->name('admin.employee.store');
Route::get('/admin/employee/edit/{id}', 'EmployeeController@adminEdit')->name('admin.employee.edit');
Route::patch('/admin/employee/edit/{id}', 'EmployeeController@adminUpdate')->name('admin.employee.update');

Route::get('/admin/table', 'TableController@adminIndex')->name('admin.table.index');
Route::get('/admin/table/create', 'TableController@adminCreate')->name('admin.table.create');
Route::post('/admin/table', 'TableController@adminStore')->name('admin.table.store');
Route::get('/admin/table/edit/{id}', 'TableController@adminEdit')->name('admin.table.edit');
Route::patch('/admin/table/edit/{id}', 'TableController@adminUpdate')->name('admin.table.update');

Route::get('/admin/client', 'ClientController@adminIndex')->name('admin.client.index');
Route::get('/admin/client/create', 'ClientController@adminCreate')->name('admin.client.create');
Route::post('/admin/client', 'ClientController@adminStore')->name('admin.client.store');
Route::get('/admin/client/edit/{id}', 'ClientController@adminEdit')->name('admin.client.edit');
Route::patch('/admin/client/edit/{id}', 'ClientController@adminUpdate')->name('admin.client.update');

Route::get('/admin/receipt', 'ReceiptController@adminIndex')->name('admin.receipt.index');
Route::get('/admin/receipt/create', 'ReceiptController@adminCreate')->name('admin.receipt.create');
Route::post('/admin/receipt', 'ReceiptController@adminStore')->name('admin.receipt.store');
Route::get('/admin/receipt/edit/{id}', 'ReceiptController@adminEdit')->name('admin.receipt.edit');
Route::patch('/admin/receipt/edit/{id}', 'ReceiptController@adminUpdate')->name('admin.receipt.update');

Route::get('/admin/order', 'OrderController@adminIndex')->name('admin.order.index');
Route::get('/admin/order/create', 'OrderController@adminCreate')->name('admin.order.create');
Route::post('/admin/order', 'OrderController@adminStore')->name('admin.order.store');
Route::get('/admin/order/edit/{id}', 'OrderController@adminEdit')->name('admin.order.edit');
Route::patch('/admin/order/edit/{id}', 'OrderController@adminUpdate')->name('admin.order.update');


Route::get('/employee/order', 'OrderController@employeeIndex')->name('employee.order.index');
Route::patch('/employee/order/setDelivered', 'OrderController@employeeSetDelivered')->name('employee.order.setDelivered');

Route::get('/employee/receipt', 'ReceiptController@employeeIndex')->name('employee.receipt.index');
Route::patch('/employee/receipt/close/{id}', 'ReceiptController@employeeCloseReceipt')->name('employee.receipt.close');

Route::get('/client/tables', 'TableController@clientIndex')->name('client.table.index');
Route::get('/client/table/{id}', 'TableController@clientShow')->name('client.table.show');

Route::get('/client/client/create', 'ClientController@clientCreate')->name('client.client.create');
Route::post('/client/client/store', 'ClientController@clientStore')->name('client.client.store');

Route::get('/client/menu', 'MenuController@clientIndex')->name('client.menu.index');
Route::get('/client/menu/{id}', 'MenuController@clientShow')->name('client.menu.show');

Route::post('/client/order/store', 'OrderController@clientStore')->name('client.order.store');
Route::get('/client/order/{id}', 'OrderController@clientShow')->name('client.order.show');

Route::get('/client/receipt/{id}', 'ReceiptController@clientShow')->name('client.receipt.show');
Route::patch('/client/receipt/close/{id}', 'ReceiptController@clientCloseReceipt')->name('client.receipt.close');

//route('admin.employee.update'); /admin/employee/edit/5
//view('employees.admin.edit'); /resources/views/employees/admin/edit.blade.php
