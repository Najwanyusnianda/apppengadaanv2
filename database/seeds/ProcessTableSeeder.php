<?php

use Illuminate\Database\Seeder;
use App\Process;

class ProcessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $process_name=['Disposisi','Pengadaan'];
        
        foreach ($process_name as $process) {
            Process::create([
                'name'=>$process,
                //'description'=>'lorem ipsum'
            ]);   
        }
    }
}
