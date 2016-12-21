<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian as Kejadian;
use App\Korban as Korban;
use App\Kendaraan as Kendaraan;
use App\Kabupaten as Kabupaten;
use Illuminate\Support\Facades\Input as Input;

use DB;
class AdminController extends Controller
{
    public function showIndex()
    {

      $kejadian = Kejadian::all();

      $korban = Korban::all();

      $sleman = Kabupaten::find(1);
      $kota = Kabupaten::find(2);
      $bantul = Kabupaten::find(3);
      $kulonprogo = Kabupaten::find(4);
      $gunungkidul = Kabupaten::find(5);
      $angka = array(
        $sleman->kejadian->count(),
        $kota->kejadian->count(),
        $bantul->kejadian->count(),
        $kulonprogo->kejadian->count(),
        $gunungkidul->kejadian->count(),
      );

      return view('admin.index',['angka' => $angka, 'korban' => $korban, 'kejadian' => $kejadian]);


    }

    public function showLakalantas()
    {
      $kejadian = Kejadian::all();
      return view('admin.datakecelakaan', ['kejadian' => $kejadian]);
    }

    public function showAllKorban()
    {
      $korban = Korban::all();
      return view('admin.datakorban', ['korban' => $korban]);
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

    public function tambahKendaraan($id)
    {

      $kendaraan = new Kendaraan();
      $kendaraan->merk =  Input::get('merk');
      $kendaraan->platnomor =  Input::get('platnomor');
      $kendaraan->warna =  Input::get('warna');
      $kendaraan->tipe_kendaraan = Input::get('kendaraan');
      $kendaraan->pengemudi_id = 0;
      $kendaraan->kejadian_id = $id;
      $kendaraan->save();

      return redirect()->route('showDetilLakalantas', ['id' => $kendaraan->kejadian_id]);

    }
    public function editKendaraan($id)
    {
        $kendaraan = Kendaraan::find($id);
        $kendaraan->merk = Input::get('merk');
        $kendaraan->tipe_kendaraan = Input::get('kendaraan');
        $kendaraan->platnomor = Input::get('platnomor');
        $kendaraan->warna = Input::get('warna');
        $kendaraan->save();

        return redirect()->route('showDetilLakalantas', ['id' => $kendaraan->kejadian_id]);
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

    public function editKorban($id)
    {
      $korban = Korban::find($id);
      $korban->nama = Input::get('nama');
      $korban->jenis_kelamin = Input::get('jenis_kelamin');
      $korban->umur = Input::get('umur');
      $korban->kondisi = Input::get('kondisi');
      $korban->kendaraan_id = Input::get('kendaraan');
      $korban->save();

      return redirect()->route('showDetilLakalantas', ['id' => $korban->kejadian_id]);
    }

    public function hapusKorban($id)
    {
      $korban = Korban::find($id);
      $korban->delete();
      return redirect()->route('showDetilLakalantas', ['id' => $korban->kejadian_id]);

    }
}
