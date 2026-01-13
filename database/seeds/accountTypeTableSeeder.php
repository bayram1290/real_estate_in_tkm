<?php

use Illuminate\Database\Seeder;
use App\accountType;

class accountTypeTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        accountType::create([
            'type_ru' => 'Собственник',
            'type_en' => 'Owner',
            'type_tm' => 'Eýesi'
        ]);

        accountType::create([
            'type_ru' => 'Риелтор',
            'type_en' => 'Agent',
            'type_tm' => 'Agent'
        ]);

    }
}
