<?php

use Illuminate\Database\Seeder;

class RevampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Revamp::create([
            'type_ru' => 'Косметический',
            'type_en' => 'Redecoration',
            'type_tm' => 'Kosmetiki'
        ]);

	    \App\Revamp::create([
            'type_ru' => 'Евроремонт',
            'type_en' => 'Western-style',
            'type_tm' => 'Ýewro-remontly'
	    ]);

	    \App\Revamp::create([
            'type_ru' => 'Дизайнерский',
            'type_en' => 'Designer decor',
            'type_tm' => 'Dizaýner bejergisi'
	    ]);

	    \App\Revamp::create([
            'type_ru' => 'Без ремонта',
            'type_en' => 'Without repair',
            'type_tm' => 'Remontsyz'
	    ]);
    }
}
