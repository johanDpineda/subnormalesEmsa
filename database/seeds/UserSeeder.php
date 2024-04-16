<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
          'name'=>'Gerente Control de Energia',
          'email'=>'johanarrenas5@gmail.com',
          'password'=>bcrypt('Emsa_2023*')
      ])->assignRole('Admin');



        
    }
}
