<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kode=["1","2","3"];
        $roles=["kulp","kasi","staff"];

        foreach ($roles as $key=>$role) {
            Role::create([
                'kode'=>$kode[$key],
                'role'=>$role,
                'description'=>'test'
            ]);
        }

    }
}
