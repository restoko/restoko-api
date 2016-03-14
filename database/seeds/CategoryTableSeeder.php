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
                'name'  => 'Shooters',
                'slug'  => 'shooters',
                'description'   => 'shooters'
            ],
            [
                'name'  => 'Cocktails',
                'slug'  => 'cocktails',
                'description'   => 'cocktails'
            ],
            [
                'name'  => 'Beers',
                'slug'  => 'beers',
                'description'   => 'beers'
            ],
            [
                'name'  => 'Specialty',
                'slug'  => 'specialty',
                'description'   => 'specialty'
            ],
            [
                'name'  => 'On The Rocks',
                'slug'  => 'on-the-rocks',
                'description'   => 'on the rocks'
            ],
            [
                'name'  => 'Tequilla Shots',
                'slug'  => 'tequilla-shots',
                'description'   => 'tequilla shots'
            ],
            [
                'name'  => 'Cogna Shots',
                'slug'  => 'cogna-shots',
                'description'   => 'cogna-shots'
            ],
            [
                'name'  => 'Per Bottle',
                'slug'  => 'per-bottle',
                'description'   => 'per bottle'
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
            ],

        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
