<?php

namespace App\Database\Seeds;

use Carbon\Carbon;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 321) as $employee) {
            $faker = Factory::create();
            $data = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'position' => $faker->jobTitle,
                'created_at' => Carbon::now('Asia/Bangkok')
            ];

            $this->db->table('employees')->insert($data);
        }
    }
}
