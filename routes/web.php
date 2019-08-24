<?php


use App\Http\Controllers\AttachmentOrchidController;

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



//Route::get('/', 'FileController@show');
//Route::get('/in', 'FileController@index');
//Route::post('files/upload', 'FileController@upload')->name('fileUploadPost');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/documents/{id}/delete', [AttachmentOrchidController::class, 'destroy'])->name('documents.delete');

