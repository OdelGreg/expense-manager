<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/dashboard');
});

//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::get('/expenses', 'ExpenseManagementController@expenses')->name('expenses');
    Route::post('/expenses/add', 'ExpenseManagementController@addExpense')->name('expenses.add');
    Route::post('/expenses/update', 'ExpenseManagementController@updateExpense')->name('expenses.update');
});

Route::group(['middleware' => ['auth', 'can:is-admin']], function () {
    Route::get('/roles', 'UserManagementController@roles')->name('roles');
    Route::post('/roles/add', 'UserManagementController@addRole')->name('roles.add');
    Route::post('/roles/update', 'UserManagementController@updateRole')->name('roles.update');

    Route::get('/users', 'UserManagementController@users')->name('users');
    Route::post('/users/add', 'UserManagementController@addUser')->name('users.add');
    Route::post('/users/update', 'UserManagementController@updateUser')->name('users.update');

    Route::get('/expense_categories', 'ExpenseManagementController@expenseCategories')->name('expense_categories');
    Route::post('/expense_categories/add', 'ExpenseManagementController@addExpenseCategory')->name('expense_categories.add');
    Route::post('/expense_categories/update', 'ExpenseManagementController@updateExpenseCategory')->name('expense_categories.update');
});