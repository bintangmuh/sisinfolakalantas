<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = "kendaraan";

    public function pengemudi()
    {
        return $this->hasOne('App\Pengemudi', 'id', 'pengemudi_id');
    }

    public function korban()
    {
        return $this->hasOne('App\Korban', 'kendaraan_id', 'id');
    }
}
