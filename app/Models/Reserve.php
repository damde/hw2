<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $table = "Reserve";

    protected $fillable = ["reservation", "room"];

    public function rooms()
    {
        return $this->hasMany("App\Models\Rooms", "room");
    }

    public function reservation()
    {
        return $this->belongsTo("App\Models\Reservations");
    }
}
