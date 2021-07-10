<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Routing\Controller;

use App\Models\Hotels;

class SearchController extends Controller
{

    public function get()
    {
        $username = session("username");

        $customer = Customers::where("username", $username)->first();

        return view("search")->with("customer", $customer);
    }

    public function post()
    {
        if (request('q')) {
            return Hotels::where("denomination", "LIKE", "%" . request("q") . "%")->get();
        }
        return [];
    }
}
