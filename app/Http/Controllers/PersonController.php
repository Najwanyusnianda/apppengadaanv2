<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use DataTables;

class PersonController extends Controller
{
    //
    public function index(){

        return view('user.userIndex');
    }

    public function personData(){
        $person=Person::query();
        $personDT=Datatables::of($person)
        ->addIndexColumn()
        ->addColumn('action',function($person){
            return '<button class="btn btn-default setting-person-button">Detail</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
        return $personDT;
    }
}
