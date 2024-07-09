<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = $this->getDataToSeed();
        foreach ($pages as $page) {
            Page::updateOrCreate([
                'slug' => $page['slug'],
            ], $page);
        }
    }

    protected function getDataToSeed(): array
    {
        return [
            // 1- about page
            [
                'title' => 'About ' . config('app.name'),
                'slug' => 'about',
                'content' => file_get_contents(public_path('html/about.html')),
            ],
            // 2- home page
            [
                'title' => config('app.name'),
                'slug' => 'home',
                'content' => "",
            ],
        ];
    }
}
