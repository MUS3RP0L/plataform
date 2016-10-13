<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Eloquent::unguard();

        $this->createModules();
        $this->createRoles();

        Eloquent::reguard();
    }

    private function createModules()
    {
        $statuses = [

            ['name' => 'Sistemas'],
            ['name' => 'Fondo de Retiro'],
            ['name' => 'Complemento Económico'],
            ['name' => 'Contabilidad'],
            ['name' => 'Presupuesto'],
            ['name' => 'Tesorería']
        ];

        foreach ($statuses as $status) {

            Muserpol\AffiliateState::create($status);
        }
    }

    private function createRoles()
    {
        $statuses = [

            ['state_type_id' => '1', 'name' => 'Administrador'],
            ['state_type_id' => '2', 'name' => 'Ventanilla'],
            ['state_type_id' => '2', 'name' => 'Certificación'],
            ['state_type_id' => '2', 'name' => 'Calificación'],
            ['state_type_id' => '2', 'name' => 'Legal'],
            ['state_type_id' => '2', 'name' => 'Administrador'],
            ['state_type_id' => '3', 'name' => 'Recepción'],
            ['state_type_id' => '3', 'name' => 'Calificación'],
            ['state_type_id' => '3', 'name' => 'Administrador']

        ];

        foreach ($statuses as $status) {

            Muserpol\Role::create($status);

        }
    }
}
