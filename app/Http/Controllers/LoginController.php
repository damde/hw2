<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Customers;

class LoginController extends Controller
{

    public function get()
    {
        return view("login");
    }

    public function post()
    {
        $username = request("username");
        $password = request("password");

        $error = "";

        if (!isset($username) || !isset($password)) {
            // ERROR
            $error = "Nome utente/Password non presenti.";
            return view("login")->with("error", $error);
        }

        $customer = Customers::where("username", request("username"))->first();
        if (!isset($customer)) {
            $error = "Utente non trovato.";
            return view("login")->with("error", $error);
        }
        if (Hash::check(request("password"), $customer->password)) {
            Session::put("username", $customer->username);
            return redirect("/");
        }
        $error = "Password non valida";
        return view("login")->with("error", $error);
    }

    public function logout()
    {
        Session::flush();
        return redirect("/");
    }

    public function isLogged()
    {
        if (Session::get("username")) {
            return array("ok" => true);
        }
        return array("ok" => false);
    }
}
