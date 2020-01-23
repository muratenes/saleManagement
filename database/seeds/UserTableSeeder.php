<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salesManagerRole = Role::where('type', Role::ROLE_SALES_MANAGER)->first();
        $salesDirectorRole = Role::where('type', Role::ROLE_SALES_DIRECTOR)->first();
        $salesRepRole = Role::where('type', Role::ROLE_SALES_REPRESENTATIVE)->first();

        $manager1 = new User();
        $manager1->name = 'Mehmet Manager';
        $manager1->email = 'mehmet@gmail.com';
        $manager1->password = Hash::make('141277kk');
        $manager1->save();
        $manager1->roles()->attach($salesManagerRole);


        $salesDirector1 = new User();
        $salesDirector1->name = 'Ahmet Director';
        $salesDirector1->email = 'ahmet@gmail.com';
        $salesDirector1->parent = $manager1->id;
        $salesDirector1->password = Hash::make('141277kk');
        $salesDirector1->save();
        $salesDirector1->roles()->attach($salesDirectorRole);

        $salesDirector2 = new User();
        $salesDirector2->name = 'Mustafa Director';
        $salesDirector2->parent = $manager1->id;
        $salesDirector2->email = 'mustafa@gmail.com';
        $salesDirector2->password = Hash::make('141277kk');
        $salesDirector2->save();
        $salesDirector2->roles()->attach($salesDirectorRole);

        $salesDirectorEmployees = [array(
            'parent' => $salesDirector1->id,
            'employees' => ['Ali', 'Burak', 'Cem', 'Dogukan', 'Erim']
        ), array(
            'parent' => $salesDirector2->id,
            'employees' => ['Cansu', 'Ece', 'Gizem'])
        ];
//        $salesDirector1EmployeesNames = ['Ali', 'Burak', 'Cem', 'Dogukan', 'Erim'];
//        $salesDirector2EmployeesNames = ['Cansu', 'Ece', 'Gizem'];

        foreach ($salesDirectorEmployees as $item) {
            foreach ($item['employees'] as $index => $employee) {
                print_r($employee);
                $mailName = strtolower($employee);
                $user = new User();
                $user->name = $employee;
                $user->parent = $item['parent'];
                $user->started_at = \Carbon\Carbon::now()->addDay(-($index + 1) * 2);
                $user->email = "$mailName@gmail.com";
                $user->password = Hash::make('141277kk');
                $user->save();
                $user->roles()->attach($salesRepRole);
            }
        }
    }
}
