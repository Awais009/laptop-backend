<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Navigation;
use App\Models\NavigationItem;
use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $nav = array(
            array('title'=>'PRODUCTS'),
            array('title'=>'LAPTOPS'),
            array('title'=>'GPU'),
            array('title'=>'MONITORS'),
            array('title'=>'PRINTERS'),
            array('title'=>'HDD'),
            array('title'=>'SSD'),
            array('title'=>'Network'),
            array('title'=>'RAM'),
            array('title'=>'PSU'),
        );
        $nav_item = array(array('title'=>'new porducts','navigation_id' => 1),array('title'=>'latest products','navigation_id' => 1));
        $cat = array(array('title' => 'category 1'),array('title' => 'category 2'),array('title' => 'category 3'),array('title' => 'category 4'));
        $sub_cat = array(array('title' => 'sub category 1','category_id' => 1),array('title' => 'sub category 2','category_id' => 1),array('title' => 'sub category 3','category_id' => 2));

        Navigation::insert($nav);
        NavigationItem::insert($nav_item);
        Category::insert($cat);
        SubCategory::insert($sub_cat);
    }
}
