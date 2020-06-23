<?php

use Illuminate\Support\Facades\Route;
use App\Events\WebHooks;
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

Route::post('/webhooks', 'WebHookController@index');
Route::get('/webhooks', 'WebHookController@create');

Route::get('/{any}', 'WebHookController@index')->where('any', '.*');
