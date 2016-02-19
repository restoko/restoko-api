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
                'user_group_id'    => 1,
                'firstname'         => 'alleo',
                'middlename'        => 'pineda',
                'lastname'          => 'indong',
                'username'          => 'admin',
                'password'          => Hash::make('password')
            ],
            [
                'user_group_id'    => 2,
                'firstname'         => 'mark wayne',
                'middlename'        => 'gurrea',
                'lastname'          => 'pulido',
                'username'          => 'cashier',
                'password'          => Hash::make('password')
            ],
            [
                'user_group_id'    => 3,
                'firstname'         => 'waiter',
                'middlename'        => '',
                'lastname'          => 'waiter',
                'username'          => 'waiter',
                'password'          => Hash::make('password')
            ],
            [
                'user_group_id'    => 4,
                'firstname'         => 'kitchen',
                'middlename'        => 'k',
                'lastname'          => 'kitchen',
                'username'          => 'kitchen',
                'password'          => Hash::make('password')
            ]
        ];


        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
