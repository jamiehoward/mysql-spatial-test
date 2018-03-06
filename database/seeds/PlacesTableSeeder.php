<?php

use App\Place;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
        	['name' => 'YMCA', 'lat' => 34.182874, 'lng' => -84.220137], //.1mi
        	['name' => 'Gym', 'lat' => 34.180459, 'lng' => -84.217820], //.3mi
        	['name' => 'Soccer Field', 'lat' => 34.182588, 'lng' => -84.213614], //.4mi
        	['name' => 'Country Club', 'lat' => 34.179960, 'lng' => -84.206705], //.9 mi
        	['name' => 'Publix', 'lat' => 34.175202, 'lng' => -84.184303], //1.98 mi
        	['name' => 'Lanier World', 'lat' => 34.180418, 'lng' => -84.030465], //10.86
        ];

        \DB::table('places')->truncate();


        foreach ($seeds as $seed) {
        	$place = new Place();
			$place->name = $seed['name'];
			$place->location = new Point($seed['lat'], $seed['lng']);
			$place->save();
        }
    }
}
