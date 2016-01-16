<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->truncate();

        $userGroups = [
            [
                'name'  => 'admin'
            ],
            [
                'name'  => 'cashier'
            ],
            [
                'name'  => 'waiter'
            ],
            [
                'name'  => 'kitchen'
            ]
        ];

        foreach ($userGroups as $group) {
            \App\Models\UserGroup::create($group);
        }
    }
}
