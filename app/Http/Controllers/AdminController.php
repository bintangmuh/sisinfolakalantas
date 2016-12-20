<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian as Kejadian;
use App\Korban as Korban;
use Illuminate\Support\Facades\Input as Input;

class AdminController extends Controller
{
    public function showIndex()
    {
      return view('admin.index');
    }

    public function showLakalantas()
    {
      $kejadian = Kejadian::all();
      return view('admin.datakecelakaan', ['kejadian' => $kejadian]);
    }

    public function showSebaran()
    {
      $kejadian = Kejadian::all();
      return view('admin.map', ['kejadian' => $kejadian]);
    }


    public function showDetilLakalantas($id)
    {
      $kejadian = Kejadian::findOrFail($id);
      return view('admin.detailkecelakaan', ['kejadian' => $kejadian]);
    }
    public function postKorban($id)
    {
      $korban = new Korban();

      $korban->nama = Input::get('nama');
      $korban->jenis_kelamin = Input::get('jenis_kelamin');
      $korban->umur = Input::get('umur');
      $korban->kondisi = Input::get('kondisi');
      $korban->kendaraan_id = Input::get('kendaraan');
      $korban->kejadian_id = $id;
      $korban->save();
      return redirect()->route('showDetilLakalantas', ['id' => $id]);

    }
}
