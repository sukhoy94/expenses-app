<?php

use App\Http\Controllers\BudgetController;
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
Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

/*/------------------------------------- expenses ----------------------------------------------------------/*/

Route::get('expenses', 'App\Http\Controllers\ExpenseController@index')->name('expenses.index');
Route::post('expenses', 'App\Http\Controllers\ExpenseController@store')->name('expenses.store');
Route::delete('expenses/{expense}', 'App\Http\Controllers\ExpenseController@delete')->name('expenses.delete');

/*/--------------------------------------------------------------------------------------------------------------/*/


/*/------------------------------------- budgets ----------------------------------------------------------/*/
Route::get('budgets', [BudgetController::class, 'index']);
/*/--------------------------------------------------------------------------------------------------------------/*/

