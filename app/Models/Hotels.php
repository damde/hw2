<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    protected $table = "Hotels";
    public function rooms()
    {
        return $this->hasMany("App\Models\Rooms");
    }
}
