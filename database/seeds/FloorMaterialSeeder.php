<?php

use Illuminate\Database\Seeder;

class FloorMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\FloorMaterial::create([
           'material_ru' => 'Полимерный',
           'material_en' => 'Polymeric',
           'material_tm' => 'Polimer'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Бетон',
            'material_en' => 'Concrete',
            'material_tm' => 'Beton'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Линолеум',
            'material_en' => 'Linoleum',
            'material_tm' => 'Linol'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Асфальт',
            'material_en' => 'Asphalt',
            'material_tm' => 'Asfalt'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Плитка',
            'material_en' => 'Tile',
            'material_tm' => 'Plitka'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Наливной',
            'material_en' => 'Bulk',
            'material_tm' => 'Guýulan'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Железобетонный',
            'material_en' => 'Reinforced concrete',
            'material_tm' => 'Demir-betondan'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Дерево',
            'material_en' => 'Wooden',
            'material_tm' => 'Agaçdan'
        ]);

        \App\FloorMaterial::create([
            'material_ru' => 'Ламинат',
            'material_en' => 'Laminate',
            'material_tm' => 'Laminat'
        ]);
    }
}
