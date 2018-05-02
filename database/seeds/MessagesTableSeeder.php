<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		
    	foreach (range(1,20) as $index) {
			$now = date('Y-m-d H:i:s', strtotime('now'));
	        DB::table('messages')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'text' => $faker->paragraph,
	            'link' => $faker->url,
				'created_at' => $now,
				'updated_at' => $now
	        ]);
        }
    }
}
