<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('component_control')->where('id', '>', '0')->delete();
      DB::table('component')->where('id', '>', '0')->delete();
      
      $this->call(ComponentTableSeeder::class);
      $this->call(ComponentControlTableSeeder::class);
    }
}
