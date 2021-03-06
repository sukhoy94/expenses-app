<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
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

Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::get('expenses/{expense}', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::delete('expenses/{expense}', [ExpenseController::class, 'delete'])->name('expenses.delete');

/*/--------------------------------------------------------------------------------------------------------------/*/


/*/------------------------------------- budgets ----------------------------------------------------------/*/
Route::get('budgets', [BudgetController::class, 'index'])->name('budgets.index');
Route::post('budgets', [BudgetController::class, 'store'])->name('budgets.store');
/*/--------------------------------------------------------------------------------------------------------------/*/

/*/------------------------------------- web api ----------------------------------------------------------/*/
Route::group(['prefix' => 'api',], function() {
    Route::get('expenses', [\App\Http\Controllers\Api\ExpenseController::class, 'index'])->name('api.expenses.index');
});
/*/--------------------------------------------------------------------------------------------------------------/*/
