<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\PermintaanData;
use App\PermintaanFile;
use App\Permintaan;

class PermintaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        //
        //$permintaan = factory(App\Permintaan::class, 10)->create();

        for ($i=0; $i <= 30 ; $i++) { 
            # code...
            $permintaan=Permintaan::create([
                'project_id'=>1,
                'kode_bagian'=> '2110',	
                
            ]);

            $data=PermintaanData::create([
                'permintaan_id'=>$permintaan->id,
                'judul'=>'Pengadaan '.$faker->name,	
                'nomor'=>'dsddaa/adada' ,	
                'kode_kegiatan'=>$faker->numberBetween($min = 1000, $max = 9000), 	
                'nama_kegiatan'=> 'kegiatan'.$faker->randomNumber(),	
                'kode_output' =>$faker->numberBetween($min = 10, $max = 90),	
                'output' =>	'output'.$faker->randomNumber,
                'kode_komponen' =>	$faker->numberBetween($min = 1000, $max = 9000),
                'komponen' =>'komponen'.$faker->randomNumber,	
                'kode_subkomponen'=>$faker->randomLetter,
                'sub_komponen' 	=>	'subkomponen'.$faker->randomNumber,
                'grup_akun' =>'grupakun',	
                'jenis_pengadaan'=>$faker->randomElement(['Barang', 'Fullboard']),
                'nilai'=>$faker->randomNumber(8), 	
                'date_mulai' =>$faker->date,	
                'date_selesai'=>$faker->date,	
                'date_created_form'=>$faker->date,
            ]);
        }
    }
}
