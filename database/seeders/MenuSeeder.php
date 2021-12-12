<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $menu = Navigation::create([
            'uid'   => 'menu',
            'title' => 'Меню',
        ]);

        Navigation::create([
            'title'     => 'Главная',
            'parent_id' => $menu->id,
        ]);

        Navigation::create([
            'title'     => 'Контакты',
            'parent_id' => $menu->id,
        ]);
    }
}
