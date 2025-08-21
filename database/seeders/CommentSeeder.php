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
            'Bagaimana cara implementasi fitur ini di project yang sudah running?',
            'Ada contoh code yang lebih lengkap tidak?',
            'Saya mengalami error saat mengikuti tutorial ini, ada solusi?',
            'Excellent explanation! Looking forward to more tutorials like this.',
            'Apakah ada video tutorial untuk topik ini?',
            'Sangat clear dan to the point. Keep up the good work!',
            'Bisa tolong jelaskan lebih detail tentang bagian authentication?',
            'Perfect timing! Kebetulan lagi butuh tutorial ini.',
            'Code example nya sangat helpful. Thank you!',
            'Artikel yang comprehensive, saved untuk reference.',
            'Mau tanya, apakah approach ini suitable untuk large scale application?',
            'Great work! Ditunggu artikel selanjutnya.',
        ];

        $authors = [
            ['name' => 'Ahmad Rahman', 'email' => 'ahmad@example.com'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@example.com'],
            ['name' => 'Michael Chen', 'email' => 'michael@example.com'],
            ['name' => 'Fatimah Zahra', 'email' => 'fatimah@example.com'],
            ['name' => 'David Kumar', 'email' => 'david@example.com'],
            ['name' => 'Lisa Wong', 'email' => 'lisa@example.com'],
            ['name' => 'Hassan Ali', 'email' => 'hassan@example.com'],
            ['name' => 'Maria Santos', 'email' => 'maria@example.com'],
            ['name' => 'Kevin Tan', 'email' => 'kevin@example.com'],
            ['name' => 'Priya Sharma', 'email' => 'priya@example.com'],
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
