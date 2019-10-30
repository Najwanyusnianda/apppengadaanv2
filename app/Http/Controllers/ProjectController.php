<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Person;
use App\User;
use App\ProjectMemberRole;
use App\ProjectActive;
use DataTables;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    //
    public function index(){
        return view('project.projectIndex');
    }



    public function projectTable(){
        $project=Project::query();
    
        $projectDT=DataTables::of($project)
        ->addIndexColumn()
        ->addColumn('action',function($project){
            $refProjectMember=route('project.manageMember',['id'=>$project->id]);
            $detailButton='<button class="btn btn-default setting-project-button">detail</button>';

            $addMemberButton='<a class="btn btn-lg" style="color:#2c3e50" href="'.$refProjectMember.'" ><i class="fas fa-users-cog "></i></a>';
            $detailButton='<a class="btn btn-lg" style="color:#16a085"  href="'.$refProjectMember.'"><i class="fas fa-list"></i></a>';;
            $groupButton='<div class="btn btn-group ">'.$detailButton.$addMemberButton.'</div>';
            return $groupButton;
        })
        ->addColumn('description', function($project){
           $trunk=Str::limit($project->description, 80);

            return $trunk;
        })
        ->addColumn('status',function($project){
            '<div class="badge badge-danger">active</div>';
        })
        ->rawColumns(['action','description','status'])
        ->make(true);

        return $projectDT;
    }


    public function activeProject(Request $request){
    
        $project_id=$request->project_id;

        $active_project=ProjectActive::where('project_id',$project_id)
        ->update([
            'isActive'=>1,
        ]);

        $other_projects=ProjectActive::where('project_id','!=',$project_id)->update(['isActive' => 0]);

        //update user role
        $projectMember=ProjectMemberRole::where('projectId',$project_id)->get();
            //dd($projectMember);
        foreach($projectMember as $member){
            $project_enroll_person=ProjectMemberRole::where('projectId',$project_id)->where("userId",$member->userId)->first();
            $user=User::where('id',$project_enroll_person->userId)->update([
                'roleActiveId'=>$project_enroll_person->roleId
            ]);
        }
       //dd($peopleId);
    
    }


}
