<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Customers;

class SignUpController extends Controller
{
    public function get()
    {
        return view("signup");
    }

    public function post()
    {
        if (request("username") && request("email") && request("password") && request("name") && request("surname")) {
            if (!preg_match('/^[a-zA-Z0-9_]{4,32}$/', request("username"))) {
                return view("signup")->with("error", "Username non rispetta le condizioni(a-Z, 0-9 _, min 4 char)");
            }

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', request("password"))) {
                return view("signup")->with("error", "La password non rispetta le condizioni");
            }

            if (!filter_var(request("email"), FILTER_VALIDATE_EMAIL)) {
                return view("signup")->with("error", "Email non valida");
            }

            if (Customers::where("username", request("username"))->orWhere("email", request("email"))->first()) {
                return view("signup")->with("error", "Username/Email giá in uso.");
            }

            $customer = Customers::create([
                'username' => request("username"),
                'name' => request("name"),
                'surname' => request("surname"),
                'email' => request("email"),
                'password' => Hash::make(request("password"))
            ]);

            Session::put("username", $customer->username);
            return redirect("/");
        } else {
            return view("signup")->with("error", "Parametri mancanti");
        }
    }
}
