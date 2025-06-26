<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'name'       => 'Tony Syafruddin',
        //         'address'    => 'Jl Gus Dur no 150 Jombang',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'name'       => 'Agus Setiawan',
        //         'address'    => 'Jl Merdeka no 150 Jombang',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'name'       => 'Kang Dedi',
        //         'address'    => 'Jl Pattimura no 150 Jombang',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];
        // <?php


    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name'       => $faker->name,
                'address'    => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];

            $this->db->table('penulis')->insert($data);
        }
    }
}


//         // Using Query Builder
//         $this->db->table('penulis')->insertBatch($data);
//     }
// }
}