<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
        $role1->type = Role::ROLE_SALES_MANAGER;
//        $role1->name = 'salesManager';
//        $role1->description = 'Satış Müdürü';
        $role1->save();

        $role2 = new Role();
//        $role2->name = 'salesDirector';
//        $role2->description = 'Satış Direktörü';
        $role2->type = Role::ROLE_SALES_DIRECTOR;
        $role2->save();

        $role3 = new Role();
        $role3->type = Role::ROLE_SALES_REPRESENTATIVE;
        $role3->save();
    }
}
