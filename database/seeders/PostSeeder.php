<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('posts')->delete();
        DB::table('comments')->delete();
        DB::table('comment_replies')->delete();

        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'email' => "user{$i}@example.com",
                'password' => bcrypt('password'), // assuming password is required
            ]);

            for ($j = 1; $j <= 5; $j++) {
                $post = Post::create([
                    'user_id' => $user->id,
                    'title' => "Post {$j} by User {$i}",
                    'description' => "This is a description for Post {$j} by User {$i}.",
                ]);

                for ($k = 1; $k <= 5; $k++) {
                    $comment = Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $user->id, // or another user if needed
                        'content' => "Comment {$k} on Post {$j} by User {$i}",
                    ]);

                    for ($l = 1; $l <= 2; $l++) {
                        CommentReply::create([
                            'comment_id' => $comment->id,
                            'user_id' => $user->id, // or another user
                            'content' => "Reply {$l} to Comment {$k} on Post {$j}",
                        ]);
                    }
                }
            }
        }
    }
}
