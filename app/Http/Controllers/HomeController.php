<?php

use App\Models\Customers;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $username = session("username");

        $customer = Customers::where("username", $username)->first();
        return view('home')->with("customer", $customer);
        
    }
}
