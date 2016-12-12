<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian as Kejadian;

class KejadianController extends Controller
{
    public function show($id)
    {
      $kejadian = Kejadian::findOrFail($id);
      return view('user.detailkejadian', ['kejadian' => $kejadian]);
    }
}
