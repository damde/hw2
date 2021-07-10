<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = "Rooms";

    public function hotel()
    {
        return $this->belongsTo("App\Models\Hotels");
    }

    public function Reserve()
    {
        return $this->belongsTo("App\Models\Reserve", "room");
    }
}
