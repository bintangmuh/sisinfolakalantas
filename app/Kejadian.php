<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kejadian extends Model
{
    protected $table ="kejadian";
    protected $dates = ['waktu_kejadian'];

    public function kendaraan()
    {
        return $this->hasMany('App\Kendaraan', 'kejadian_id', 'id');
    }

    public function sender()
    {
        return $this->hasOne('App\User', 'id', 'sender_id');
    }

    public function kabupaten()
    {
      return $this->hasOne('App\Kabupaten','id', 'kabupaten_id');
    }

    public function korban()
    {
      return $this->hasMany('App\Korban','kejadian_id', 'id');
    }
}
