<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = "Customers";

    protected $fillable = ["username", "name", "surname", "email", "password"];

    public function reservations()
    {
        return $this->hasMany("App\Models\Reservations");
    }
}
