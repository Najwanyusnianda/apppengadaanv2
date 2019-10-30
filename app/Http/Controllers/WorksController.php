<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Person;
use App\Project;
use App\ProjectMemberRole;
use App\Permintaan;
use App\PermintaanGroup;
use App\ProjectActive;
use App\DisposisiPermintaan;
use Carbon\Carbon;
use DataTables;

class WorksController extends Controller
{
    //index
    public function index(){
        return view('works.disposisiBaruIndex');
    }

    public function workLoadIndex(){
        return view('works._workloadTable');
    }

    
    public function disposisiForm($permintaanId){
        $project_active=ProjectActive::where('isActive',1)->first();
        $permintaan=Permintaan::find($permintaanId);
        $kasie=ProjectMemberRole::where('projectId',$project_active->project_id)
        ->join('users','users.id','project_member_roles.userId')
        ->join('people','people.userId','=','users.id')
        ->where('project_member_roles.roleId','=','2')
        ->select('users.id AS userId','people.name AS name')
        ->get();

        $staff=ProjectMemberRole::where('projectId',$project_active->project_id)
        ->join('users','users.id','project_member_roles.userId')
        ->join('people','people.userId','=','users.id')
        ->where('project_member_roles.roleId','=','3')
        ->select('users.id AS userId','people.name AS name')
        ->get();

        return view('works._disposisiForm')
        ->with('kasie',$kasie)
        ->with('staff',$staff)
        ->with('permintaan',$permintaan);
    }

    //table
    public function disposisiNewTable(){

        $project_active=ProjectActive::where('isActive',1)->first();
        if(auth()->user()->roleActiveId==1){//bila kulp
        $permintaan=Permintaan::where('project_id',$project_active->project_id)
        ->join('permintaan_data AS data','data.permintaan_id','=','permintaans.id')
        ->where('permintaans.state_id','=',1)
        ->join('bagians AS a','a.kode_bagian','=','permintaans.kode_bagian')
        ->select('permintaans.id AS id','jenis_pengadaan','kode_kegiatan','a.nama AS nama_bagian','a.kode_bagian','nilai','nomor','judul','state_id','permintaans.created_at')

        ->get();
        }
        elseif(auth()->user()->roleActiveId==2){//bila kasi
            $permintaan=Permintaan::where('project_id',$project_active->project_id)
            ->join('permintaan_data AS data','data.permintaan_id','=','permintaans.id')
            ->join('permintaan_groups AS groups','groups.permintaan_id','=','permintaans.id')
            ->where('permintaans.state_id','=',2)
            ->where('groups.id_kasi',auth()->user()->id)
            ->join('bagians AS a','a.kode_bagian','=','permintaans.kode_bagian')
            ->select('permintaans.id AS id','jenis_pengadaan','kode_kegiatan','a.nama AS nama_bagian','a.kode_bagian','nilai','nomor','judul','state_id')
            ->get();
        }elseif (auth()->user()->roleActiveId==3) {//bila staf
            # code...
            $permintaan=Permintaan::where('project_id',$project_active->project_id)
            ->join('permintaan_data AS data','data.permintaan_id','=','permintaans.id')
            ->where('permintaans.state_id','=',3)
            ->join('bagians AS a','a.kode_bagian','=','permintaans.kode_bagian')
            ->select('permintaans.id AS id','jenis_pengadaan','kode_kegiatan','a.nama AS nama_bagian','a.kode_bagian','nilai','nomor','judul','state_id')
            ->get();
            
        }
        $dt=DataTables::of($permintaan)
        ->addIndexColumn()
        ->addColumn('judul_',function($permintaan){
            $judul=$permintaan->judul;
            $date_human=Carbon::parse($permintaan->created_at)->diffForHumans();
            $badge='<span class="badge badge-secondary badge-pill">'.$date_human.'</span>';
            $temp=$judul.' '.$badge;
            return $temp;
            
        })
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
            $refdisposisiForm=route('works.disposisiForm',[$permintaan->id]);
            $detailButton='<button class="btn btn-primary btn-sm" style="font-size:0.75rem">Detail</button>';
            $disposisiButton='<a class="btn disposisi-button" style="color:#e67e22" href="'.$refdisposisiForm.'"><i class="fas fa-paper-plane"></i></a>';
            $btn_group='<div class="btn-group">'.$disposisiButton.'</div>';
            return $btn_group;
        })
        ->rawColumns(['status','harga','action','judul_'])
        ->make(true);

        return $dt;
    }

    public function stafWorkloadTable(){
        $project_active=ProjectActive::where('isActive',1)->first();
        
        $staff=ProjectMemberRole::query()->where('projectId','=',$project_active->project_id)
        ->where('project_member_roles.roleId',3)
        ->join('people','people.userId','=','project_member_roles.userId')
        ->select('people.userId AS id','people.nip','people.name')
        ->get();
        //dd($staff);
       /* $countWork=Permintaan::query()
        ->where('project_id',$project_active->project_id)
        ->join('permintaan_groups','permintaan_groups.permintaan_id','=','permintaans.id')
        //->rightJoin('project_member_roles AS member','member.userId','=','permintaan_groups.id_staf')
        //->where('member.roleId',3)
        ->select(DB::raw('count(id_staf) AS jumlah_permintaan,nama_staf,nip_staf'))
        ->groupBy('nama_staf','nip_staf','id_staf')
        
        ->get();
        dd($countWork);*/
        $dt=DataTables::of($staff)
        ->addIndexColumn()
        ->addColumn('count',function($staff){
            $project_active=ProjectActive::where('isActive',1)->first();
            $countWork=Permintaan::query()
                ->where('project_id',$project_active->project_id)
                ->join('permintaan_groups','permintaan_groups.permintaan_id','=','permintaans.id')
                ->select(DB::raw('count(id_staf) AS jumlah_permintaan,id_staf,nip_staf ,nama_staf'))
                ->groupBy('nama_staf','nip_staf','id_staf')
                ->get();
            
                $text=0;
            foreach ($countWork as $count) {
                if($staff->id==$count->id_staf){
                $text=$count->jumlah_permintaan;
                } 
            }  
           $ref="lol"; 
 
           $button ='<a href="'.$ref.'" class="badge badge-primary badge-pill p-1">'.'<span class="text-center" style="font-size=0.8rem">'.$text.'</span>'.'</a>';
           return $button;
        })
        ->addColumn('action',function($staff){

        })
        ->rawColumns(['count','action'])
        ->make(true);

        return $dt;
    }

    public function sendDisposisi(Request $request){

        //jika yang ngirim kepala
        if(auth()->user()->roleActiveId==1 ){
           
            $permintaan=Permintaan::find($request->permintaanId);
           
            // apabila permintaan baru
            if($permintaan->state_id==1){
                //assigned kasi

                $kulp=Person::where('userId',auth()->user()->id)->first();
                $kasi=Person::where('userId',$request->kasi)->first();
                $assigned=PermintaanGroup::create([
                    'permintaan_id'=>$request->permintaanId,
                    'id_kulp'=>$kulp->userId,
                    'nama_kulp'=>$kulp->name,
                    'nip_kulp'=>$kulp->nip,
                    'id_kasi'=>$kasi->userId,
                    'nama_kasi'=>$kasi->name,
                    'nip_kasi'=>$kasi->nip
                ]);

                //post disposisi
                $disposisiData=DisposisiPermintaan::create([
                    'permintaan_id'=>$request->permintaanId,
                    'from_id'=>auth()->user()->id,
                    'to_id'=>$request->kasi,
                    'konten'=>$request->isiDisposisi,
                    'disposisi_level'=>1
               
                    
                ]);

                //update status permintaan
                $permintaan->update([
                    'state_id'=>2
                ]);
    
                $person=Person::where('userId',$request->kasi)->first();
    
                return $person;
            }
           

 

        }
         //bila status=="disposisi
        elseif(auth()->user()->roleActiveId==2){
            $permintaan=Permintaan::find($request->permintaanId);

    
            if($permintaan->state_id==2){

                //assigned
                $staff=Person::where('userId',$request->staff)->first();
                $assigned=PermintaanGroup::where('permintaan_id',$request->permintaanId)->first();
                $assigned->update([
                    'id_staf'=>$staff->userId,
                    'nama_staf'=>$staff->name,
                    'nip_staf'=>$staff->nip
                ]);

                //post disposisi
                $disposisiData=DisposisiPermintaan::where('permintaan_id',$permintaan->id);
                $disposisiData->update([
                    'permintaan_id'=>$request->permintaanId,
                    'from_id'=>auth()->user()->id,
                    'to_id'=>auth()->user()->id,
                    'konten'=>$request->isiDisposisi,
                    'disposisi_level'=>2
                    
                ]);

                //update status permintaan
                $permintaan->update([
                    'state_id'=>3
                ]);
    
                $person=Person::where('userId',$request->staff)->first();
    
                return $person;
            }
        }
    }

    public function getStafWork(){

    }


}