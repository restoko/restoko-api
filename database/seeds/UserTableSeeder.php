<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $users = [
            [
                'user_groups_id'    => 1,
                'firstname'         => 'alleo',
                'middlename'        => 'pineda',
                'lastname'          => 'indong',
                'email'             => 'admin@javalogy.ph',
                'password'          => Hash::make('password')
            ],
            [
                'user_groups_id'    => 2,
                'firstname'         => 'mark wayne',
                'middlename'        => '',
                'lastname'          => 'pulido',
                'email'             => 'cashier@javalogy.ph',
                'password'          => Hash::make('password')
            ],
            [
                'user_groups_id'    => 3,
                'firstname'         => 'waiter',
                'middlename'        => '',
                'lastname'          => 'waiter',
                'email'             => 'waiter@javalogy.ph',
                'password'          => Hash::make('password')
            ],
            [
                'user_groups_id'    => 4,
                'firstname'         => 'kitchen',
                'middlename'        => '',
                'lastname'          => 'kitchen',
                'email'             => 'kitchen@javalogy.ph',
                'password'          => Hash::make('password')
            ]
        ];


        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}