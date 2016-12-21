<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korban extends Model
{
    protected $table="korban";

    public function kendaraan() {
      return $this->belongsTo('App\Kendaraan');
    }
    public function kejadian() {
      return $this->belongsTo('App\Kejadian');
    }
}
