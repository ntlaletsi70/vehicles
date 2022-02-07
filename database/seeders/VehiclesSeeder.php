<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('vehicles')->insert([
            'make' => 'Ford',
            'model' => 'Ecoboost-1.5 Ambition',
            'year_of_manufacture' => 2020,
            'price' => 250000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);


        DB::table('vehicles')->insert([
            'make' => 'Volkswagen',
            'model' => 'Amarok 3.0 V6 TDI Double Cab Extreme 4Motion',
            'year_of_manufacture' => 2021,
            'price' => 560000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('vehicles')->insert([
            'make' => 'Toyota',
            'model' => '2016 Toyota Auris 1.6 XR Auto ',
            'year_of_manufacture' => 2016,
            'price' => 350000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
