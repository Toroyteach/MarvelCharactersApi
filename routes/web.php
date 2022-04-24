<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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
    return view('welcome');
});

//shows users form to upload the csv file
Route::get('/uploadFile', [IndexController::class, 'upload'])->name('upload.csv'); //loads view
Route::post('/upload', [IndexController::class, 'uploadCsvFile'])->name('upload'); //uploads file

//loads the characters to the home page
Route::get('/characters', [IndexController::class, 'characters'])->name('characters'); //loads characters
