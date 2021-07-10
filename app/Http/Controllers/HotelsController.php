<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Hotels as ModelsHotels;
use Illuminate\Routing\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\App;

class HotelsController extends Controller
{
    public function getHotels()
    {
        $limit = request("limit");
        $hotels = [];
        if (isset($limit)) {
            $hotels = ModelsHotels::limit($limit)->get();
        } else {
            $hotels =  ModelsHotels::all();
        }
        $results = [];
        foreach ($hotels as $hotel) {


            $city = explode(", ", $hotel->address);

            $curlS = curl_init();

            curl_setopt($curlS, CURLOPT_URL, "http://api.weatherstack.com/current?access_key=" . env("WEATHERSTACKAPI", "") . "&query=" . $city[1]);
            curl_setopt($curlS, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlS, CURLOPT_HEADER, false);

            $result = curl_exec($curlS);
            $hotel->weather = json_decode($result)->current;
            
            $results[] = $hotel;

            curl_close($curlS);
        }
        return $results;
    }

    public function getHotel($id)
    {
        $hotel = ModelsHotels::where("id", $id)->first();
        if ($hotel) {
            $username = session("username");

            $customer = Customers::where("username", $username)->first();

            return view("hotel")->with("customer", $customer)->with("hotel", $hotel);
        }
        return redirect("/");
    }
}
