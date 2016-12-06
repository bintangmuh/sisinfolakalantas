<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kejadian extends Model
{
    protected $table ="kejadian";

    public function kendaraan()
    {
        return $this->hasMany('App\Kendaraan', 'kejadian_id', 'id');
    }
}
