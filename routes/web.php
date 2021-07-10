<?php

use App\Models\Customers;
use Illuminate\Contracts\Session\Session;
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
    $username = session("username");

    $customer = Customers::where("username", $username)->first();

    return view('home')->with("customer", $customer);
});

Route::get('login', "App\Http\Controllers\LoginController@get");
Route::post('login', "App\Http\Controllers\LoginController@post");

Route::get('logout', "App\Http\Controllers\LoginController@logout");

Route::get('signup', "App\Http\Controllers\SignUpController@get");
Route::post('signup', "App\Http\Controllers\SignUpController@post");

Route::get('search', "App\Http\Controllers\SearchController@get");

Route::get('hotel/{id}', "App\Http\Controllers\HotelsController@getHotel");

Route::get('checkAvailability', "App\Http\Controllers\ReservationController@checkAvailability");
Route::get('makeReservation', "App\Http\Controllers\ReservationController@makeReservation");

Route::get('reservations', function () {
    $username = session("username");
    if(!$username) {
        return redirect("login");
    }
    $customer = Customers::where("username", $username)->first();
    return view("reservations")->with("customer", $customer);
});

Route::get('reservationsList', "App\Http\Controllers\ReservationController@getReservations");

Route::get('deleteReservation/{reservation}', "App\Http\Controllers\ReservationController@deleteReservation");

Route::get('reviews/{id}', "App\Http\Controllers\ReviewsController@getReviews");
Route::post('review', "App\Http\Controllers\ReviewsController@postReview");

