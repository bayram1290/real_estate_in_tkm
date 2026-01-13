<?php

use Illuminate\Database\Seeder;
use App\typeRent;

class typeRentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        typeRent::create([
            'r_type_ru' => 'Длительно',
            'r_type_en' => 'Long-term',
            'r_type_tm' => 'Dowamly'
        ]);

        typeRent::create([
            'r_type_ru' => 'Посуточно',
            'r_type_en' => 'Daily',
            'r_type_tm' => 'Gündelik'
        ]);
    }
}
