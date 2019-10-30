<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //$this->call(UsersTableSeeder::class);
      $this->call(ProjectTableSeeder::class);
      $this->call(ProcessTableSeeder::class);
      $this->call(StateTableSeeder::class);
      $this->call(UserTempTableSeeder::class);
      $this->call(RoleTableSeeder::class);
      $this->call(BagianTableSeeder::class);
      $this->call(PermintaanTableSeeder::class);
    }
}
