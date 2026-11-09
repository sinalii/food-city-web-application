<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            ['code' => 'CAT001', 'name' => 'Rice & Grocery Essentials', 'products' => [
                ['Premium Nadu Rice', 'Araliya', '5 kg', 1150], ['White Raw Rice', 'Nipuna', '5 kg', 1149],
                ['Red Dhal', 'Harischandra', '1 kg', 320], ['Wheat Flour', 'Prima', '1 kg', 320],
                ['White Sugar', 'Kist', '1 kg', 250], ['Basmati Rice', 'Daawat', '1 kg', 1820],
                ['Coconut Oil', 'Marina', '1 L', 1660], ['Chickpeas', 'Orient', '500 g', 380],
                ['Table Salt', 'Catch', '400 g', 130], ['Atta Flour', 'Wijaya', '1 kg', 449],
            ]],
            ['code' => 'CAT002', 'name' => 'Dairy & Chilled Products', 'products' => [
                ['Full Cream Milk Powder', 'Anchor', '400 g', 1300], ['Full Cream Milk Powder', 'Anchor', '1 kg', 3250],
                ['Fresh Milk', 'Ambewela', '1 L', 500], ['Vanilla Set Yoghurt', 'Newdale', '80 g', 80],
                ['Drinking Yoghurt', 'Kotmale', '180 ml', 150], ['Cheese Slices', 'Kraft', '200 g', 1150],
                ['Butter Salted', 'Anchor', '200 g', 950], ['UHT Milk', 'Highland', '1 L', 450],
                ['Chocolate Milk', 'Kotmale', '180 ml', 180], ['Vanilla Ice Cream', 'Elephant House', '1 L', 1200],
            ]],
            ['code' => 'CAT003', 'name' => 'Biscuits, Snacks & Confectionery', 'products' => [
                ['Chocolate Cream Biscuits', 'Munchee', '200 g', 180], ['Lemon Puff Biscuits', 'Maliban', '200 g', 220],
                ['Milk Shortcake', 'Munchee', '200 g', 190], ['Nice Biscuits', 'Maliban', '200 g', 180],
                ['Chocolate Wafers', 'Ritzbury', '100 g', 250], ['Chocolate Cream Biscuits', 'Oreo', '133 g', 350],
                ['Chocolate Fingers', 'Munchee', '100 g', 180], ['Stix Chocolate', 'Munchee', '20 g', 29],
                ['O-kay Chocolate', 'Tiara', '18 g', 29], ['Strawberry Cake', 'Little Lion', '200 g', 390],
            ]],
        ];

        foreach ($catalog as $index => $categoryData) {
            $category = Category::updateOrCreate(
                ['code' => $categoryData['code']],
                ['name' => $categoryData['name'], 'sort_order' => $index + 1],
            );

            foreach ($categoryData['products'] as [$name, $brand, $packSize, $price]) {
                Product::updateOrCreate(
                    ['category_id' => $category->id, 'name' => $name, 'brand' => $brand, 'pack_size' => $packSize],
                    ['price_lkr' => $price, 'is_deal' => false],
                );
            }
        }
    }
}
