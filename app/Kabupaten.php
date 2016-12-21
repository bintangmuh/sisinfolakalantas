<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table="kabupaten";

    public function kejadian() {
      return $this->hasMany('App\Kejadian', 'kabupaten_id', 'id');
    }
}
