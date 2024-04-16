<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class municipalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $municipalities = [
            [
                'name'=>'Acacias',
            ],
            [
                'name'=>'Barranca de Upia',
            ],
            [
                'name'=>'Cabuyaro',
            ],
            [
                'name'=>'Calvario',
            ],
            [
                'name'=>'Castilla la Nueva',
            ],
            [
                'name'=>'El Castillo',
            ],
            [
                'name'=>'Cubarral',
            ],
            [
                'name'=>'San juanito',
            ],
            [
                'name'=>'Cumaral',
            ],
            [
                'name'=>'El Dorado',
            ],
            [
                'name'=>'Fuente de Oro',
            ],
            [
                'name'=>'Granada',
            ],
            [
                'name'=>'Guamal',
            ],
            [
                'name'=>'Lejanias',
            ],
            [
                'name'=>'La Macarena',
            ],
            [
                'name'=>'Mapiripan',
            ],
            [
                'name'=>'Mesetas',
            ],
            [
                'name'=>'Puerto Concordia',
            ],
            [
                'name'=>'Puerto Gaitan',
            ],
            [
                'name'=>'Puerto Lleras',
            ],
            [
                'name'=>'Puerto Lopez',
            ],
            [
                'name'=>'Puerto Rico',
            ],
            [
                'name'=>'Restrepo',
            ],
            [
                'name'=>'San Carlos Guaroa',
            ],
            [
                'name'=>'San Juan de Arama',
            ],
            [
                'name'=>'San Martin de los Llanos',
            ],
            [
                'name'=>'Villavicencio',
            ],
            [
                'name'=>'Uribe',
            ],
            [
                'name'=>'Vista Hermosa',
            ]
          

        ];
        \App\Models\municipalities::insert($municipalities);
    }
}
