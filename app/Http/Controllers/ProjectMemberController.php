<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Person;
use App\ProjectMemberRole;
use App\ProjectActive;
use App\User;
use DataTables;


class ProjectMemberController extends Controller
{
    //
    public function memberRoleIndex($id){
       
        $project=Project::find($id);

        $project_active=ProjectActive::where('project_id',$id)->first();
  
        
        $projectMember=ProjectMemberRole::where('projectId',$project->id)->get();
        if($projectMember->isEmpty()){
            $person=Person::all();
        }else{
            $peopleId=[];
            foreach($projectMember as $member){
                $peopleId[]=$member->personId;
            }
        

            $person=Person::whereNotIn('id',$peopleId)->get();
            
        }

        
        return view('project.memberRoleIndex')
        ->with('project_id',$project->id)
        ->with('project_name',$project->name)
        ->with('active_status',$project_active->isActive)
        ->with('people',$person);
    }

    //data untuk form select2 member
    public function addMemberToProject($id){
        $project=Project::find($id);
        $projectMember=ProjectMemberRole::where('projectId',$project->id)->get();
        if($projectMember->isEmpty()){
            $person=Person::all();
        }else{
           
            foreach($projectMember  as $member){
                $peopleId[]=$member->userId;
            }
            
         
            $person=Person::whereNotIn('userId',$peopleId)->get();
            
        }
        return view('project._addMemberForm')
        ->with('project_id',$project->id)
        ->with('people',$person);
    }


    public function projectMemberStore($id,Request $request){
       
       $members_id=$request->members_id;
       foreach ($members_id as $member_id) {
        $store_data=ProjectMemberRole::create([
            'projectId'=>$id, 	
            'userId'=>$member_id
        ]);
       }

    }

    public function projectMemberTable($id){
        $member=ProjectMemberRole::where('projectId',$id)
        ->join('users','users.id','=','project_member_roles.userId')
        ->join('people','people.userId','=','users.id')
        ->leftJoin('roles','roles.kode','=','project_member_roles.roleId')
        ->select('people.name','people.nip','people.id','roles.role')
        ->get();
     
     
        $dt=DataTables::of($member)
        ->addIndexColumn()
        ->addColumn('action',function($member){
            $refEditMember="/project/config/member/".$member->id;
            $refDeleteMember="/project/config/member/delete".$member->id;
            
            $editMemberButton='<a class="btn btn-primary btn-sm configMember" href="'.$refEditMember.'"><i class="fas fa-pencil-alt"></i> <strong style="font-size:0.7rem">Edit</strong></a>';
            $deleteMemberButton='<a class="btn btn-danger btn-sm deleteMember ml-2" href="'.$refDeleteMember.'"><i class="fas fa-trash"></i><strong style="font-size:0.7rem">Delete</strong></a>';
            return "<div class='btn-group'>".$editMemberButton.$deleteMemberButton."</div>";
        })
        ->rawColumns(['action'])
        ->make(true);
        return $dt;
    }


    public function updateRoleForm($id){
        $person_detail=Person::where('people.id',$id)->leftJoin('users','users.id','=','people.id')
        ->select('people.id AS id','people.name','people.nip','users.email','users.username','users.id AS user_id')
        ->first();
        return view('project._updateProjectMemberData')
        ->with('person_detail',$person_detail);
    }

    public function updateRole($id,Request $request){
       
        $project=Project::find($id);
        $user_id=$request->user_id;
        $person= Person::where('id',$user_id)->first();

        $projectMember=ProjectMemberRole::where('projectId',$project->id)
        ->where('userId',$user_id)->update([
            'roleId'=>$request->person_role,
        ]);

    }
}
