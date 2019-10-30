<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BagianController extends Controller
{

    //
    public function DaftarBagian(){
        return view('bagian.daftarBagian');
    }
}
