<?php

use Illuminate\Database\Seeder;
use App\Person;
use App\User;
use Faker\Factory as Faker;

class UserTempTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('people')->delete();
        //DB::table('users')->delete();
        $faker = Faker::create('id_ID');
        $user1= User::create([
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'isAdmin'=>1
        ]);

        $person1=Person::create([
            'name'=>'admin',
            'nip'=>'test',
            'userId'=>$user1->id
        ]);

        for($i = 1; $i <= 50; $i++){
            $user2= User::create([
                'username'=>$faker->username,
                'email'=>$faker->email,
                'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    
            ]);
    
            $person2=Person::create([
                'name'=>$faker->name,               
                'nip'=>$faker->numerify('#############'),
                'userId'=>$user2->id
    
            ]);
        }
    }
}
