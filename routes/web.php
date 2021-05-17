<?php

use Illuminate\Support\Facades\Route;
use App\Models\Client;
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

Route::get('account', function() {
    dd(2);
    return Client::all();
});

Route::post('register', function(Request $request) {
    return  Client::create($request->all());
});
