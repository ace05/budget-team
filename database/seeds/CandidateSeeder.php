<?php

use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = \Faker\Factory::create();
    	$data = [];
    	for ($i= 1; $i <= 5000 ; $i++) { 
    		array_push($data, [
    			'name' => $faker->name,
    			'experience' => $faker->randomDigitNotNull(),
    			'expected_salary' => rand(10000, 99999)
    		]);
    	}

        $userData = \DB::table('candidates')->raw(function ( $collection ) use ($data) {
            return $collection->insertMany($data);
        });
    }
}
