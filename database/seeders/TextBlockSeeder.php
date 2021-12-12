<?php

namespace Database\Seeders;

use App\Models\Textblock;
use Illuminate\Database\Seeder;

class TextBlockSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Textblock::create([
            'uid'   => 'copyrights',
            'title' => 'Подпись внизу сайта (Copyrights)',
            'text'  => '© ' . date('Y') . ' ' . config('app.name'),
        ]);
        Textblock::create([
            'uid'   => 'address',
            'title' => 'Адрес',
            'text'  => 'Кишинёв, М. Маноле 5а',
        ]);
        Textblock::create([
            'uid'   => 'phone',
            'title' => 'Телефон',
            'text'  => '+(373) 78 000 000',
        ]);
    }
}
