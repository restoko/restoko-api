<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = [
            [
                'name'  => 'Beverages',
                'slug'  => 'beverages',
                'description'   => 'inumin'
            ],
            [
                'name'  => 'Sandwitches',
                'slug'  => 'sandwitches',
                'description'   => 'sandwitches'
            ]
        ];

        foreach ($categories as $category) {

        }
    }
}
