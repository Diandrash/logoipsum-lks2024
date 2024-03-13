<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Subscribe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Diandra Farel',
            'email' => 'diandra@gmail.com',
            'password' => 123456,
            'is_admin' => 0,
        ]);

        User::factory()->create([
            'name' => 'Rizal Zaky',
            'email' => 'rizal@gmail.com',
            'password' => 123456,
            'is_admin' => 0,
        ]);

        Category::factory()->create([
            'name' => 'Business'
        ]);
        Category::factory()->create([
            'name' => 'Fintech'
        ]);
        Category::factory()->create([
            'name' => 'Sports'
        ]);
        Category::factory()->create([
            'name' => 'Healty'
        ]);

        Article::factory()->create([
            'author_id' => 1,
            'category_id' => 1,
            'title' => 'Inflasi Ekonomi 2023',
            'slug' => 'inflasiekonomi2023',
            'text' => 'lorem ipsum',
            'image' => 'img-01.png'
        ]);
    }
}
