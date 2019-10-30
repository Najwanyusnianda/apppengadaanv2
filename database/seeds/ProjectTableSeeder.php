<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Project;
use App\ProjectActive;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //$project = factory(App\Project::class, 10)->create();
        $faker = Faker::create('id_ID');


        //
        for ($i=0; $i <10 ; $i++) { 
            # code...
            $project=Project::create([
                'name'=>'Project'. $faker->name(),
                'description'=>$faker->text()
            ]);
    
            $project_actives=ProjectActive::create([
                'project_id'=>$project->id
            ]);
        }


    }
}
