<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use App\User as User;
use Auth as Auth;
use Carbon\Carbon as Carbon;
use App\Kejadian as Kejadian;
use App\Kendaraan as Kendaraan;



class UserController extends Controller
{
    public function beranda(){
      $kejadian = Kejadian::where('waktu_kejadian','>',Carbon::today())
                  ->where('waktu_kejadian','<',Carbon::today()->addDay())
                  ->get();
      return view('user.home', array('kejadian' => $kejadian));
    }

    public function listKejadian(){
      $kejadian = Kejadian::where('sender_id', '=', Auth::user()->id)->orderBy('waktu_kejadian', 'DESC')->get();
      return view('user.datakejadian', array('kejadian' => $kejadian));
    }

    public function addKejadian() {
      $kejadian = new Kejadian();
      $kejadian->latitude = Input::get('latitude');
      $kejadian->longitude = Input::get('longitude');
      $kejadian->kabupaten_id = Input::get('kabupaten');
      $kejadian->sender_id = Auth::user()->id;
      $kejadian->waktu_kejadian = Carbon::now();
      $kejadian->save();

      for ($i=0; $i < count(Input::get('kendaraan.*')); $i++) {
        $kendaraan = new Kendaraan();
        $kendaraan->tipe_kendaraan = Input::get('kendaraan.'.$i.'');
        $kendaraan->merk =  Input::get('merk.'.$i.'');
        $kendaraan->warna =  Input::get('warna.'.$i.'');
        $kendaraan->platnomor =  Input::get('plat.'.$i.'');
        $kendaraan->pengemudi_id = 0;
        $kendaraan->kejadian_id = $kejadian->id;
        $kendaraan->save();
      }

      // return Input::all();
      return redirect()->route('detailkejadian', ['id' => $kejadian->id]);
    }

    public function search() {
      $kejadian = Kejadian::where('waktu_kejadian','>',Carbon::parse(Input::get('date'))->format('Y-m-d'))
                  ->where('waktu_kejadian','<',Carbon::parse(Input::get('date'))->addDay()->format('Y-m-d'))
                  ->get();
      return view('user.home', array('kejadian' => $kejadian));
    }

}
