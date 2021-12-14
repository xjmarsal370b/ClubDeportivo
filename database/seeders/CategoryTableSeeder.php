<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'id'                 => 1,
                'cat_name'               => 'Fútbol',
            ],
            [
                'id'                 => 2,
                'cat_name'               => 'Tenis',
            ],
            [
                'id'                 => 3,
                'cat_name'               => 'Baloncesto',
            ],
            [
                'id'                 => 4,
                'cat_name'               => 'Badminton',
            ],
            [
                'id'                 => 5,
                'cat_name'               => 'Atletismo',
            ],
            [
                'id'                 => 6,
                'cat_name'               => 'Natación',
            ],
        ];

        PostCategory::insert($categories);
    }
}
