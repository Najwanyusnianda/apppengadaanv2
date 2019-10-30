<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DisposisiPermintaan;
use App\Project;
use App\ProjectActive;
use App\Permintaan;
use App\Person;
use App\User;
use DataTables;

class DisposisiMessageController extends Controller
{
    //

    public function inboxIndex(){
        return view('inbox.messageBoxIndex');
    }

    public function sentIndex(){
        return view('inbox.messageSentIndex');
    }


    public function inboxTable(){
        $project_active=ProjectActive::where('isActive',1)->first();
        $permintaan=Permintaan::where('project_id',$project_active->project_id)->get();


        $permintaanId=[];
        foreach($permintaan as $data){
            $permintaanId[]=$data->id;
        }
    

        $disposisi_permintaan=DisposisiPermintaan::whereIn('disposisi_permintaans.permintaan_id',$permintaanId)
        ->where('to_id',auth()->user()->id)
        ->join('people','people.userId','=','to_id')
        ->join('permintaan_data','permintaan_data.permintaan_id','=','disposisi_permintaans.permintaan_id')
        ->select('permintaan_data.permintaan_id','disposisi_permintaans.konten AS konten','permintaan_data.judul','disposisi_permintaans.created_at AS created','people.name AS pengirim','people.nip AS pengirim_nip','disposisi_permintaans.updated_at AS updated')
        ->get();

        $dt=DataTables::of($disposisi_permintaan)->make(true);
        return $dt;
    }


    public function sentTable(){
        $project_active=ProjectActive::where('isActive',1)->first();
        $permintaan=Permintaan::where('project_id',$project_active->project_id)->get();


        $permintaanId=[];
        foreach($permintaan as $data){
            $permintaanId[]=$data->id;
        }
    

        $disposisi_permintaan=DisposisiPermintaan::whereIn('disposisi_permintaans.permintaan_id',$permintaanId)
        ->where('from_id',auth()->user()->id)
        ->join('people','people.userId','=','to_id')
        ->join('permintaan_data','permintaan_data.permintaan_id','=','disposisi_permintaans.permintaan_id')
        ->select('permintaan_data.permintaan_id','disposisi_permintaans.konten AS konten','permintaan_data.judul','disposisi_permintaans.created_at AS created','people.name AS penerima','people.nip AS penerima_nip','disposisi_permintaans.updated_at AS updated')
        ->get();

        $dt=DataTables::of($disposisi_permintaan)
        ->addIndexColumn()
        ->make(true);
        return $dt;
    }
}
