<?php

use Illuminate\Database\Seeder;
use App\RoomLayout;

class RoomLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        RoomLayout::create([
            'room_layout_ru' => 'Все квадратные',
            'room_layout_en' => 'All square',
            'room_layout_tm' => 'Hemmesi kwadrat'
        ]);
        
        RoomLayout::create([
            'room_layout_ru' => 'Квадратные и угловые',
            'room_layout_en' => 'Square and angular',
            'room_layout_tm' => 'Kwadrat we burçly'
        ]);

        RoomLayout::create([
            'room_layout_ru' => 'Квадратные и полукруглые',
            'room_layout_en' => 'Square and semicircular',
            'room_layout_tm' => 'Kwadrat we ýarym aýlawly'
        ]);

        RoomLayout::create([
            'room_layout_ru' => 'Полукруглые и угловые',
            'room_layout_en' => 'Angular and semicircular',
            'room_layout_tm' => 'Burçly we ýarym aýlawly'
        ]);
    }
}
