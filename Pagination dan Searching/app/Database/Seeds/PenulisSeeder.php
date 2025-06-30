<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
//use Faker\Factory; 

class PenulisSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID'); 

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'name'         => $faker->name,
                'address'      => $faker->address,
                'email'        => $faker->email,
                'tanggal_lahir'=> $faker->date,
                'create_at'    => Time::createFromTimestamp($faker->unixTime()),
                'update_at'    => Time::now()
            ];

            
            $this->db->table('penulis')->insert($data);
        }
    }
}
