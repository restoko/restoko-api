<?php

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 20; $i++) {
            \App\Models\Table::create(
                [
                    'name'  => 'table '.$i,
                    'slug'  => 'table-'.$i,
                    'status'    => 'available'
                ]
            );
        }
    }
}
