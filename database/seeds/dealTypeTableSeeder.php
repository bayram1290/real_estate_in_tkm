<?php

use Illuminate\Database\Seeder;
use App\dealType;
class dealTypeTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        dealType::create([
            'deal_ru' => 'Аренда',
            'deal_en' => 'Rent',
            'deal_tm' => 'Kärende'
        ]);

        dealType::create([
            'deal_ru' => 'Продажа',
            'deal_en' => 'Sale',
            'deal_tm' => 'Satlyk'
        ]);
    }
}
