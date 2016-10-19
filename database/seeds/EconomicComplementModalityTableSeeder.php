<?php

use Illuminate\Database\Seeder;

class EconomicComplementModalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Eloquent::unguard();

        $this->EconomicComplementTypes();
        $this->EconomicComplementModalities();

        Eloquent::reguard();
    }

    private function EconomicComplementTypes()
    {
        $statuses = [

            ['name' => 'Vejez'],
            ['name' => 'Viudedad'],
            ['name' => 'Orfandad']

        ];

        foreach ($statuses as $status) {

            Muserpol\EconomicComplementType::create($status);
        }
    }

    private function EconomicComplementModalities()
    {
        $statuses = [

            ['name' => 'Normal', 'description' => 'Renta asociada con el (la) beneficiario (a) titular', 'shortened' => 'Vejez'],
            ['name' => 'Normal', 'description' => 'Renta sociada con el (la) viuda (o) del titular', 'shortened' => 'Viudedad'],
            ['name' => 'Normal', 'description' => 'Renta asociada con el (la) huérfano (o) del titular', 'shortened' => 'Orfandad'],
            ['name' => 'RENT-1COMP', 'description' => 'Un solo componente', 'shortened' => 'R-1C'],
            ['name' => 'RENT-1COMP', 'description' => 'Un solo componente', 'shortened' => 'R-1C'],
            ['name' => 'RENT-1COMP-M2000', 'description' => 'Un solo componente y menor a Bs. 2000,00', 'shortened' => 'R-1C-M2000'],
            ['name' => 'RENT-1COMP-M2000', 'description' => 'Un solo componente y menor a Bs. 2000,00', 'shortened' => 'R-1C-M2000'],
            ['name' => 'RENT-M2000', 'description' => 'Renta menor a Bs. 2000,00', 'shortened' => 'R-M2000'],
            ['name' => 'RENT-M2000', 'description' => 'Renta menor a Bs. 2000,00', 'shortened' => 'R-M2000'],

        ];

        foreach ($statuses as $status) {

            Muserpol\EconomicComplementModality::create($status);
        }
    }
}
