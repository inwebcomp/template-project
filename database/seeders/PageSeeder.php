<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'slug'   => 'index',
            'title' => 'Главная страница',
        ]);
    }
}
