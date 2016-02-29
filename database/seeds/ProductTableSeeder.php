<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

        $products = [
            [
                'category_id'   => 1,
                'name' => 'Tex-Mex Nachos',
                'slug'  => 'tex-mex-nachos',
                'description' => 'Platter of Ncho Chips Topped with Sautees Beef, Cheese Saucce and Flavored Dressing.',
                'price' => '250',
                'picture' => 'http://http://52.192.161.52/uploads/image1.jpeg'
            ],
            [
                'category_id'   => 1,
                'name' => 'Java Chicken Wings',
                'slug'  => 'java-chicken-wings',
                'description' => 'Deep Fried 3 pieces Chicken wings Coated with BBQ Sauce Served with Crudities in Java Aioli',
                'price' => '140',
                'picture' => 'http://http://52.192.161.52/uploads/image2.jpeg'
            ],
            [
                'category_id'   => 2,
                'name' => 'Javalicious Braised Short ribs BBQ',
                'slug'  => 'javalicious-braised-short-ribs-bbq',
                'description' => 'Slow cooked Braised Short ribs Served with Com and Carrots Mashed Potatoes with Java BBQ Sauce',
                'price' => '275',
                'picture' => 'http://http://52.192.161.52/uploads/image3.jpeg'
            ],
            [
                'category_id'   => 2,
                'name' => 'Grilled Pork Steak',
                'slug'  => 'grilled-pork-steak',
                'description' => 'Marinated Pork Steak Grilled to Perfection Served with Buttered Vegetables, Rice and Java Gravy',
                'price' => '280',
                'picture' => 'http://http://52.192.161.52/uploads/image4.jpeg'
            ],
            [
                'category_id'   => 2,
                'name' => 'Herb and Nut Crusted fish Fillet',
                'slug'  => 'product-5',
                'description' => 'Crispy Pan- Fried Fish fillet  Coated with Herbs and Nuts Served with Green Salad and Rice',
                'price' => '190',
                'picture' => 'http://http://52.192.161.52/uploads/image5.jpeg'
            ],
            [
                'category_id'   => 3,
                'name' => 'Combo 1',
                'slug'  => 'combo-1',
                'description' => 'Breaded prok with MushrooM Gravy, Rice, Coleslaw, Blue Lemonade, Free Soup',
                'price' => '79',
                'picture' => 'http://http://52.192.161.52/uploads/image6.jpeg'
            ],
            [
                'category_id'   => 3,
                'name' => 'Combo 2',
                'slug'  => 'combo-2',
                'description' => 'Grilled chicken Breast Inasal,Coleslaw, Rice, Blue Lemonade, Free Soup',
                'price' => '79',
                'picture' => 'http://http://52.192.161.52/uploads/image7.jpeg'
            ],
            [
                'category_id'   => 3,
                'name' => 'Combo 3',
                'slug'  => 'combo-3',
                'description' => 'Stir-Fried Beef and Vegetables Salpicao, Coleslaw, Rice, Blue Lemonade, Free Soup',
                'price' => '99',
                'picture' => 'http://http://52.192.161.52/uploads/image8.jpeg'
            ],
            [
                'category_id'   => 4,
                'name' => 'Java Caezar Salad',
                'slug'  => 'product-7',
                'description' => 'Our Version of Caesar salad, Lettuce, Bacon, Croutons, Parmesan Cheese Served with Homemade Caezar Dressing',
                'price' => '155',
                'picture' => 'http://http://52.192.161.52/uploads/image9.jpeg'
            ],
            [
                'category_id'   => 4,
                'name' => 'Java Garden Salad',
                'slug'  => 'product-7',
                'description' => 'Lettuce, Tomato, Turnips, Carrots, Cucumber, Bell Peppers Served with Honey Orange Vinaigratte',
                'price' => '115',
                'picture' => 'http://http://52.192.161.52/uploads/image10.jpeg'
            ],
            [
                'category_id'   => 4,
                'name' => 'Java Chicken Pizza7',
                'slug'  => 'product-7',
                'description' => 'Marinated Grilled chicken with Creamy White Sauce over Thinly Baked Crust',
                'price' => '165',
                'picture' => 'http://http://52.192.161.52/uploads/image11.jpeg'
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
