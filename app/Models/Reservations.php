<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = "Reservations";

    protected $fillable = ["customers", "startDate", "endDate", "totalPrice"];

    public function customer()
    {
        return $this->belongsTo("App\Models\Customers");
    }

    public function reserve()
    {
        return $this->hasMany("App\Models\Reserve");
    }
}
