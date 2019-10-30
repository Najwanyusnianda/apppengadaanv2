<?php

use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $state_disposisi=['start','disposition','process'];

        foreach ($state_disposisi as $state) {
           
            State::create([
                'process_id'=>1,
                'name'=>$state,
                'description'=>'lorem'
            ]);
        }
    }
}
