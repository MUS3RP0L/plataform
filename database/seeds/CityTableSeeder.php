<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Eloquent::unguard();

        $this->createCities();

        Eloquent::reguard();
    }

    private function createCities()
    {
        $statuses = [

            ['name' => 'BENI', 'shortened' => 'BN', 'second_shortened' => 'BEN'],
            ['name' => 'CHUQUISACA', 'shortened' => 'CH', 'second_shortened' => 'SUC'],
            ['name' => 'COCHABAMBA', 'shortened' => 'CB', 'second_shortened' => 'CBB'],
            ['name' => 'LA PAZ', 'shortened' => 'LP', 'second_shortened' => 'LPZ'],
            ['name' => 'ORURO', 'shortened' => 'OR', 'second_shortened' => 'ORU'],
            ['name' => 'PANDO', 'shortened' => 'PN', 'second_shortened' => 'PDO'],
            ['name' => 'POTOSÍ', 'shortened' => 'PO', 'second_shortened' => 'PTS'],
            ['name' => 'SANTA CRUZ', 'shortened' => 'SC', 'second_shortened' => 'SCZ'],
            ['name' => 'TARIJA', 'shortened' => 'TJ', 'second_shortened' => 'TJA']

        ];

        foreach ($statuses as $status) {

            Muserpol\City::create($status);

        }
    }
}
