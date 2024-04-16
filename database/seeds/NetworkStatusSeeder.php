<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class NetworkStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $networkstatus = [
            [
                'name'=>'Perfectas Condiciones',
            ],
            [
                'name'=>'Malas Condiciones',
            ],
            [
                'name'=>'Condiciones Estables',
            ]

        ];
        \App\Models\NetworkStatus::insert($networkstatus);

    }
}
