<?php

use Illuminate\Support\Facades\Route;
use App\Events\WebHooks;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
    $websiteId = isset($request["website_id"]) ? $request["website_id"] : "";
    return view('welcome',['websiteId' => $websiteId]);
});

Route::get('/403', function () {
    return view('403');
});

Route::post('/webhooks', 'WebHookController@index');
Route::post('/products', 'WebHookController@create');

Route::get('/{any}', 'WebHookController@index')->where('any', '.*');
