<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        $commentTexts = [
            'Artikel yang sangat bermanfaat! Terima kasih atas penjelasan yang detail.',
            'Saya baru saja mulai belajar Laravel, artikel ini sangat membantu.',
            'Tutorial yang mudah diikuti, even untuk pemula seperti saya.',

        ];

        $authors = [
            ['name' => 'Ahmad Rahman', 'email' => 'ahmad@example.com'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@example.com'],
            ['name' => 'Michael Chen', 'email' => 'michael@example.com'],

        ];

        foreach ($posts as $post) {
            // Add random number of comments per post (1-6 comments)
            $numComments = rand(1, 6);

            for ($i = 0; $i < $numComments; $i++) {
                $author = $authors[array_rand($authors)];
                $comment = $commentTexts[array_rand($commentTexts)];

                Comment::create([
                    'content' => $comment,
                    'author_name' => $author['name'],
                    'author_email' => $author['email'],
                    'post_id' => $post->id,
                    'user_id' => null, // Anonymous comments
                    'created_at' => $post->created_at->addHours(rand(1, 72)), // Comments added within 3 days of post
                    'updated_at' => $post->created_at->addHours(rand(1, 72)),
                ]);
            }
        }
    }
}
