<?php

use App\Models\municipalities;
use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\municipalitiesSeeder;
use App\Models\User;
use Database\Seeders\NetworkStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call([
           
            RoleSeeder::class,
            UserSeeder::class,
            municipalitiesSeeder::class,
            NetworkStatusSeeder::class
           
//            GroupTeamSeeder::class,
//            PlayerSeeder::class,
            
        ]);
    }
}
