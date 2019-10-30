<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permintaan;
use App\PermintaanData;
use App\PermintaanFile;
use App\Project;
use App\ProjectActive;
use Carbon\Carbon;
use DataTables;


class PermintaanController extends Controller
{
    //
    public function permintaanIndex(){
        return view('permintaan.permintaanIndex');
       
    }
    public function permintaanBaruIndex($project_id){
        return view('permintaan.permintaanBaruIndex')
        ->with('projectId',$project_id);
    }
    public function permintaanDisposisiIndex(){

    }
    public function permintaanTable(){
        $project_active=ProjectActive::where('isActive',1)->first();
        $permintaan=Permintaan::where('project_id',$project_active->project_id)
        ->join('permintaan_data AS data','data.permintaan_id','=','permintaans.id')
        ->join('bagians AS a','a.kode_bagian','=','permintaans.kode_bagian')
        ->select('permintaans.id AS permintaan_id','permintaans.created_at','data.nilai','data.judul','data.kode_kegiatan','a.nama AS nama','data.jenis_pengadaan')
        ->get();
        //dd($permintaan);
        $dt=DataTables::of($permintaan)
        ->addIndexColumn()
        ->addColumn('judul_',function($permintaan){
            $judul=$permintaan->judul;
            $date_human=Carbon::parse($permintaan->created_at)->diffForHumans();
            $badge='<span class="badge badge-secondary badge-pill">'.$date_human.'</span>';
            $temp=$judul.' '.$badge;
            return $temp;
            
        }
        )
        ->addColumn('status',function($permintaan){
            $badgeStatus=$permintaan->state_id==1 ? 'danger' : ($permintaan->state_id==2 ? "warning" : "primary" );
            $status=$permintaan->state_id==1 ? 'Baru' : ($permintaan->state_id==2 ? "Disposisi" : "Proses" );
            $Badge='<div class="badge badge-'.$badgeStatus.'">'.$status.'</div>';
            return $Badge;
        })
        ->addColumn('harga',function($permintaan){
            $nilai="Rp." .number_format($permintaan->nilai,0,',','.').",-";
            return "<strong>".$nilai."</strong>";
        })
        ->addColumn('action',function($permintaan){
            $ref="lol";
            $detailButton='<a class="btn btn-primary btn-sm" style="font-size:0.75rem" href="'.$ref.'">Detail</a>';
            return $detailButton;
        })
        ->rawColumns(['status','harga','action','judul_'])
        ->make(true);

        return $dt;
        
    }
    
}
