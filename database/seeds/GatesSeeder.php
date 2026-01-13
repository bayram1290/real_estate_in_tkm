<?php

use Illuminate\Database\Seeder;

class GatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gates::create([
            'gate_ru' => 'На пандусе',
            'gate_en' => 'On the ramp',
            'gate_tm' => 'Pandusuň üstünde'
        ]);

        \App\Gates::create([
            'gate_ru' => 'Докового типа',
            'gate_en' => 'The dock type',
            'gate_tm' => 'Dok görnüşinde'
        ]);

        \App\Gates::create([
            'gate_ru' => 'На нулевой отметке',
            'gate_en' => 'At ground level',
            'gate_tm' => 'Diwan bilen deň derejede'
        ]);
    }
}
