<?php

use Illuminate\Database\Seeder;
use App\typePropertyList;

class typePropertyListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        typePropertyList::create([
            'code' => '111',
            'opt1' => '1',
            'opt2' => '3',
            'opt3' => '4',
            'opt4' => '6',
            'opt5' => '7',
            'opt6' => '8',
            'opt7' => '9',
            'opt8' => '0',
            'opt9' => '0',
        ]);

        typePropertyList::create([
            'code' => '112',
            'opt1' => '12',
            'opt2' => '13',
            'opt3' => '14',
            'opt4' => '15',
            'opt5' => '16',
            'opt6' => '17',
            'opt7' => '18',
            'opt8' => '19',
            'opt9' => '20',
        ]);

        typePropertyList::create([
            'code' => '121',
            'opt1' => '1',
            'opt2' => '3',
            'opt3' => '5',
            'opt4' => '4',
            'opt5' => '0',
            'opt6' => '0',
            'opt7' => '0',
            'opt8' => '0',
            'opt9' => '0',
        ]);

        typePropertyList::create([
            'code' => '231',
            'opt1' => '1',
            'opt2' => '2',
            'opt3' => '3',
            'opt4' => '10',
            'opt5' => '6',
            'opt6' => '7',
            'opt7' => '8',
            'opt8' => '9',
            'opt9' => '11',
        ]);

        typePropertyList::create([
            'code' => '232',
            'opt1' => '12',
            'opt2' => '13',
            'opt3' => '14',
            'opt4' => '15',
            'opt5' => '16',
            'opt6' => '17',
            'opt7' => '18',
            'opt8' => '19',
            'opt9' => '20',
        ]);
    }
}
