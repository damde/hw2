<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Reservations;
use App\Models\Reserve;
use App\Models\Rooms;

use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class ReservationController extends Controller
{
    public function deleteReservation($reservation)
    {

        $username = Session::get("username");

        if (!$username) {
            return redirect("login");
        }

        Reserve::where("reservation", $reservation)->delete();
        Reservations::where("IDReservation", request("reservation"))->delete();
        return array("ok" => true);
    }

    public function getReservations()
    {
        $username = Session::get("username");
        if (!$username) {
            return redirect("login");
        }
        $result = [];
        $reservations = Reservations::where("customers", $username)->get();
        foreach ($reservations as $reservation) {
            $reserves = Reserve::where("reservation", $reservation->IDReservation)->get();
            $reservation->reserves = $reserves;
            $hotel = "";
            foreach ($reserves as $reserve) {
                $hotel = Rooms::where("IDRoom", $reserve->room)->first()->hotel;
                break;
            }

            $reservation->hotel = $hotel;
            $result[] = $reservation;
        }
        return $result;
    }

    public function checkAvailability()
    {
        if (!Session::get("username")) {
            return array("notLogged" => true);
        }
        
        $startDate = date(request("startDate"));
        $endDate = date(request("endDate"));
        $hotel = request("hotel");

        $result = array();

        if ($startDate > $endDate) {
            return array("error", true);
        }

        $rooms = [];

        if (isset($r)) {
            $rooms =  Rooms::where("IDRoom", $r)->get();
        } else {
            $rooms =  Rooms::where("hotel", $hotel)->get();
        }
            
        foreach ($rooms as $room) {
            $reserves = Reserve::where("room", $room->IDRoom)->get();
            if ($reserves->count()) {
                $found = false;
                foreach ($reserves as $reserve) {
                    $reservation = Reservations::where("IDReservation", $reserve->reservation)->first();
                    if (
                        $reservation::whereBetween("startDate", [$startDate, $endDate])
                        ->orWhereBetween("endDate", [$startDate, $endDate])->count()
                    ) {
                       $found = true; 
                       break;
                    }
                }

                if(!$found) {
                    $result[] = $room;
                }
            } else {
                $result[] = $room;
            }
        }
        return $result;
    }

    public function makeReservation()
    {

        $startDate = date(request("startDate"));
        $endDate = date(request("endDate"));
        $room = request("room");

        $result = [];

        $reserves = Reserve::where("room", $room)->get();

        $found = false;
        if ($reserves->count()) {
            foreach ($reserves as $reserve) {
                $reservation = Reservations::where("IDReservation", $reserve->reservation)->first();
                if (
                    $reservation::whereBetween("startDate", [$startDate, $endDate])
                    ->orWhereBetween("endDate", [$startDate, $endDate])->count()
                ) {
                   $found = true; 
                }
            }
            if(!$found) {
                $result[] = $room;
            }
        } else {
            $result[] = $room;
        }
        $error = "";
        if (array_count_values($result)) {
            $username = Session::get("username");
            if ($username) {
                $roomQ = Rooms::where("IDRoom", $room)->first();
                if (!$roomQ) {
                    $error =  "Errore, stanza non trovata";
                } else {
                    $reservation = Reservations::create([
                        'customers' => $username,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'totalPrice' => (abs(strtotime($endDate) - strtotime($startDate)) / 86400) * $roomQ->price
                    ]);
                    $reserve = Reserve::create([
                        'reservation' => $reservation->id,
                        'room' => $roomQ->IDRoom
                    ]);
                    return array(
                        "ok" => true
                    );
                }
            } else {
                $error = "Sessione non valida";
            }
        } else {
            $error = "Stanza non disponibile";
        }
        return array(
            "error" => $error
        );
    }
}
