<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        DB::table("users")->delete();
        DB::table("posts")->delete();

        // Créer des utilisateurs
        User::create(['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'password' => Hash::make('password123')]);
        User::create(['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'password' => Hash::make('securepwd')]);
        User::create(['id' => 3, 'name' => 'Peter Jones', 'email' => 'peter.jones@example.com', 'password' => Hash::make('secret123')]);
        User::create(['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice.brown@example.com', 'password' => Hash::make('mypass')]);

        // Créer des posts
        Post::create(['id' => 1, 'user_id' => 1, 'title' => 'My First Post', 'slug' => 'my-first-post', 'body' => 'This is the body of my first post.', 'is_published' => 1]);
        Post::create(['id' => 2, 'user_id' => 1, 'title' => 'Another Thought', 'slug' => 'another-thought', 'body' => 'Just sharing another thought I had.', 'is_published' => 1]);
        Post::create(['id' => 3, 'user_id' => 2, 'title' => 'Jane\'s Introduction', 'slug' => 'janes-introduction', 'body' => 'Hello everyone, I\'m Jane!', 'is_published' => 1]);
        Post::create(['id' => 4, 'user_id' => 1, 'title' => 'Draft Post (Not Public)', 'slug' => 'draft-post-not-public', 'body' => 'This post is still a draft.', 'is_published' => 0]);
        Post::create(['id' => 5, 'user_id' => 3, 'title' => 'Learning Laravel', 'slug' => 'learning-laravel', 'body' => 'My journey into the world of Laravel.', 'is_published' => 1]);
        Post::create(['id' => 6, 'user_id' => 2, 'title' => 'My Favorite Hobby', 'slug' => 'my-favorite-hobby', 'body' => 'Talking about what I love to do.', 'is_published' => 1]);
        Post::create(['id' => 7, 'user_id' => 4, 'title' => 'Exploring New Ideas', 'slug' => 'exploring-new-ideas', 'body' => 'Some fresh perspectives I\'ve been thinking about.', 'is_published' => 1]);
    }
}
