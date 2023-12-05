<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();

        $category_data = [
            [
                'designer_id' => 2,
                'name' => 'Women\'s',
                'slug' => 'women\'s',
                'image' => '1700553772.jpg',
                'parent_category_id' => null,
                'created_at' => '2023-11-20 05:14:52',
                'updated_at' => '2023-11-20 05:14:52',

            ],

            [
                'designer_id' => 2,
                'name' => 'Men\'s',
                'slug' => 'men\'s',
                'image' => '1700553851.jpg',
                'parent_category_id' => null,
                'created_at' => '2023-11-20 05:14:52',
                'updated_at' => '2023-11-20 05:14:52',

            ],

            [
                'designer_id' => 2,
                'name' => 'kids',
                'slug' => 'kids',
                'image' => '1700553889.jpg',
                'parent_category_id' => null,
                'created_at' => '2023-11-20 05:14:52',
                'updated_at' => '2023-11-20 05:14:52',

            ],

            [
                'designer_id' => 2,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'image' => '1700553949.jpg',
                'parent_category_id' => null,
                'created_at' => '2023-11-20 05:14:52',
                'updated_at' => '2023-11-20 05:14:52',

            ],

        ];

        foreach($category_data as $data){
            DB::table('categories')->insert([
             'designer_id' => $data['designer_id'],
             'name' => $data['name'],
             'slug' => $data['slug'],
             'image' => $data['image'],
             'parent_category_id' => $data['parent_category_id'],
             'created_at' => $data['created_at'],
             'updated_at' => $data['updated_at'],
            ]);
        }
    }
}
