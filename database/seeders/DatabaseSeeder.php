<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Truncate all the tables.
        User::truncate();
        Category::truncate();
        Post::truncate();

        // Create users.
        $steve = User::factory()->create([
            'name' => 'Steve Rogers',
            'email' => 'steverogers@avengers.com',
        ]);

        $tony = User::factory()->create([
            'name' => 'Tony Stark',
            'email' => 'tonystark@avengers.com',
        ]);

        // Create categories.
        $phpCategory = Category::create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);

        $javascriptCategory = Category::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
        ]);

        $saveThePlanetCategory = Category::create([
            'name' => 'Save The Planet',
            'slug' => 'save-the-planet',
        ]);

        // Create Posts.
        Post::create([
            'title' => 'PHP 7 New Features',
            'slug' => 'php-7-new-features',
            'excerpt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'category_id' => $phpCategory->id,
            'user_id' => $steve->id,
        ]);

        Post::create([
            'title' => 'ES 6 New Features',
            'slug' => 'es6-new-features',
            'excerpt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'category_id' => $javascriptCategory->id,
            'user_id' => $tony->id,
        ]);
    }
}
