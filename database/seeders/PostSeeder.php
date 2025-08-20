<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'title' => 'Asas Laravel untuk Pemula',
            'content' => 'This is a sample post content.',
            'author' => 'John Doe',
            'author_info' => 'Pengajar Laravel',
            'image' => 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?w=256&h=256&fit=crop',
            'category' => 'Laravel',
        ]);

        Post::create([
            'title' => 'Menguasai Eloquent ORM',
            'content' => 'Eloquent ORM adalah bagian penting dari Laravel.',
            'author' => 'Jane Smith',
            'author_info' => 'Pengajar Laravel',
            'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
            'category' => 'Laravel',
        ]);
    }
}
