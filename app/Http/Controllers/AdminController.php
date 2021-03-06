<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian as Kejadian;
use App\User as User;
use App\Korban as Korban;
use App\Kendaraan as Kendaraan;
use App\Kabupaten as Kabupaten;
use Illuminate\Support\Facades\Input as Input;
use Alert;
use Auth;
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

      $angkakendaraan = DB::table('kendaraan')
                     ->select(DB::raw('count(*) as jumlah, tipe_kendaraan'))
                     ->groupBy('tipe_kendaraan')
                     ->get();

      $pertumbuhan = Kejadian::select(DB::raw('DATE(waktu_kejadian) as date, count(*) as jumlah'))
                      ->orderBy('waktu_kejadian', 'ASC')
                      ->groupBy('date')
                      ->get();
      $laporanbaru = Kejadian::select('*')->orderBy('waktu_kejadian', 'DESC')->limit(5)->get();
      return view('admin.index',['angka' => $angka, 'korban' => $korban, 'kejadian' => $kejadian, 'angkakendaraan' => $angkakendaraan, 'pertumbuhan' => $pertumbuhan, 'laporanbaru' => $laporanbaru]);
    }

    public function profile() {
      $user =  User::find(Auth::user()->id);
      return view('admin.profile', ['user' => $user ]);
    }

    public function editprofile() {
      $user =  User::find(Auth::user()->id);
      $user->name = Input::get('name');
      $user->email = Input::get('email');
      $user->address = Input::get('address');
      $user->save();

      Alert::success('Edit Profile Berhasil', 'Menyunting profil telah dilakukan')->autoclose(3500);

      return redirect()->route('admin.profile');
    }

    public function adminList() {
      $admin = User::where('role', 'admin')->get();
      $user = User::where('role', 'user')->get();
      return view('admin.administratorlist', ['admin' => $admin, 'users' => $user]);
    }

    public function addAdmin($id) {
      $user = User::find($id);
      $user->role = Input::get('role');
      $user->save();
      Alert::success('Menambah Admin dengan nama:'.$user->nama.' Berhasil', 'Menambah admin telah dilakukan')->autoclose(2000);

      return redirect()->route('admin.list');
    }

    public function showLakalantas()
    {
      $kejadian = Kejadian::all();
      return view('admin.datakecelakaan', ['kejadian' => $kejadian]);
    }

    public function showAllKorban()
    {
      $korban = Korban::all();
      $gender = Korban::select(DB::raw('count(*) as jumlah, jenis_kelamin'))
                ->groupBy('jenis_kelamin')
                ->get();
      $umur = array(
        'balita' => Korban::where('umur', '>=', 0)->where('umur', '<', 6)->count(),
        'anak' => Korban::where('umur', '>=', 6)->where('umur', '<', 17)->count(),
        'dewasa' => Korban::where('umur', '>=', 17)->where('umur', '<', 50)->count(),
        'lansia' => Korban::where('umur', '>=', 50)->count()
      );

      return view('admin.datakorban', ['korban' => $korban, 'gender' => $gender, 'umur' => ($umur)]);
    }

    public function showSebaran()
    {
      $kejadian = Kejadian::all();
      return view('admin.map', ['kejadian' => $kejadian]);
    }

    public function filter()
    {
      return redirect()->route('showsebaran', ['month' => Input::get('month'),'year' => Input::get('year')]);
    }

    public function filterSebaran($month, $year)
    {
      $kejadian = Kejadian::whereMonth('waktu_kejadian', '=', $month)
                  ->whereYear('waktu_kejadian', '=', $year)
                  ->get();
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
      Alert::success($kendaraan->merk . ' ' . $kendaraan->warna . ' ' . $kendaraan->platnomor, 'Menambah kendaraan telah dilakukan')->autoclose(5000);

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
        Alert::success('Success Message', 'Edit Kendaraan telah dilakukan')->autoclose(3000);
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
      Alert::success('Nama: '. $korban->nama .'', 'Menambah Korban telah dilakukan')->autoclose(3000);
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

      Alert::success('Nama: '. $korban->nama .'', 'Menyunting Korban telah dilakukan')->autoclose(3000);
      return redirect()->route('showDetilLakalantas', ['id' => $korban->kejadian_id]);
    }

    public function hapusKorban($id)
    {
      $korban = Korban::find($id);
      $korban->delete();
      Alert::success('Nama: '. $korban->nama .'', 'Menghapus Korban telah dilakukan')->autoclose(3000);
      return redirect()->route('showDetilLakalantas', ['id' => $korban->kejadian_id]);
    }
}
