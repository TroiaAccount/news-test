<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::query()->create([
            'locale' => 'en',
            'prefix' => 'en',
        ]);

        Language::query()->create([
            'locale' => 'ru',
            'prefix' => 'ru',
        ]);
    }
}
