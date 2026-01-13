<?php

use Illuminate\Database\Seeder;

class PriceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PriceUnit::create([
            'unit' => 'У.Е'
        ]);

        \App\PriceUnit::create([
           'unit' => 'TMT'
        ]);
    }
}
