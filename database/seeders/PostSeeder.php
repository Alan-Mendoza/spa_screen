<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'name' => 'Post 1',
        ]);

        Post::create([
            'name' => 'Post 2',
        ]);

        Post::create([
            'name' => 'Post 3',
        ]);

        Post::create([
            'name' => 'Post 4',
        ]);

        Post::create([
            'name' => 'Post 5',
        ]);

        Post::create([
            'name' => 'Post 6',
        ]);

        Post::create([
            'name' => 'Post 7',
        ]);

        Post::create([
            'name' => 'Post 8',
        ]);

        Post::create([
            'name' => 'Post 9',
        ]);

        Post::create([
            'name' => 'Post 10',
        ]);
    }
}
