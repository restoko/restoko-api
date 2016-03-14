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
        \App\Models\Table::create(
            [
                'name'  => 'table 1',
                'slug'  => 'table-1',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table 2',
                'slug'  => 'table-2',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table 3',
                'slug'  => 'table-3',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table 4',
                'slug'  => 'table-4',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table 5',
                'slug'  => 'table-5',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table vip-1',
                'slug'  => 'table-vip-1',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table vip-2',
                'slug'  => 'table-vip-2',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table o-1',
                'slug'  => 'table-o-1',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table o-2',
                'slug'  => 'table-o-2',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table o-3',
                'slug'  => 'table-o-3',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table b-1',
                'slug'  => 'table-b-1',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table b-2',
                'slug'  => 'table-b-2',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table b-3',
                'slug'  => 'table-b-3',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table b-4',
                'slug'  => 'table-b-4',
                'status'    => 'available'
            ]
        );

        \App\Models\Table::create(
            [
                'name'  => 'table b-5',
                'slug'  => 'table-b-5',
                'status'    => 'available'
            ]
        );


    }
}
