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
                'name'  => 'Appetizers',
                'slug'  => 'appetizers',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Chefs Recommendations',
                'slug'  => 'chiefs-recommendations',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Student Meals',
                'slug'  => 'student-meals',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Pizzas and Salads',
                'slug'  => 'pizzas-salads',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Non-coffee based drinks',
                'slug'  => 'non-coffee-based-drinks',
                'description'   => 'inumin'
            ],
            [
                'name'  => 'Javalogy Classics',
                'slug'  => 'javalogy-classics',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Javalogy Specialties',
                'slug'  => 'javalogy-specialties',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Frost',
                'slug'  => 'frost',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Over-Iced',
                'slug'  => 'over-iced',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Signature Drinks',
                'slug'  => 'signature-drinks',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Alcoholic Coffee Beverages',
                'slug'  => 'javalogy-classics',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Gourmet, Burgers, Paninis and Quesadillas',
                'slug'  => 'gourmet-burgers-paninis-quesadillas',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Rice Extras',
                'slug'  => 'rice-extras',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Pasta',
                'slug'  => 'pasta',
                'description'   => 'sandwitches'
            ],
            [
                'name'  => 'Desserts',
                'slug'  => 'desserts',
                'description'   => 'sandwitches'
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
