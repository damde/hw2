<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Reviews;
use App\Models\Reservations;
use App\Models\Rooms;
use App\Models\Reserve;

class ReviewsController extends Controller{
    public function getReviews($id){
        return Reviews::where("hotel", $id)->get();
    }

    public function postReview(){
        $username = Session::get("username");
        $hotel = request("hotel");

        if(!$username) {
            return redirect("login");
        }
        
        $x = DB::select("SELECT * FROM Reservations
        JOIN Reserve ON Reserve.reservation = Reservations.IDReservation
        JOIN Rooms ON Reserve.room = Rooms.IDRoom
        WHERE Rooms.hotel = $hotel AND Reservations.customers = '$username'");
        if(count($x)) {
            Reviews::insert([
                "customer"=>$username,
                "text"=>request("text"),
                "hotel"=>request("hotel")
            ]);
            return back();
        }
    }
}