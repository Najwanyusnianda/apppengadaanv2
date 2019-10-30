<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PermintaanData;
use Faker\Generator as Faker;

$factory->define(PermintaanData::class, function (Faker $faker) {
    return [
        //
        'project_id'=>1,
        'kode_bagian'=> '2110',	
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
    ];
});
