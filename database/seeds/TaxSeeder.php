<?php

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tax::create([
           'tax_ru' => 'НДС включен',
           'tax_en' => 'VAT included',
           'tax_tm' => ''
        ]);

        \App\Tax::create([
            'tax_ru' => 'НДС не включен',
            'tax_en' => 'VAT not included',
            'tax_tm' => ''
        ]);

        \App\Tax::create([
            'tax_ru' => 'УСН (упрощенная система налогообложения)',
            'tax_en' => 'USN (simplified tax system)',
            'tax_tm' => ''
        ]);
    }
}
