<?php

use Illuminate\Database\Seeder;
use App\Bagian;

class BagianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bagians')->delete();
        $json= File::get("database/data/subject_bagian.json");
        $data=json_decode($json);
        foreach ($data as $obj) {
            Bagian::create(array(
                'kode_bagian'=> $obj->kode_bagian,
                'kode_bagian_up'=>$obj->kode_bagian_up,
                'nama'=>$obj->nama_bagian
            ));
        }
    }
}
