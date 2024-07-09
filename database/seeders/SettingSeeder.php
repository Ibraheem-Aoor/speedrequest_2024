<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = $this->getDataToSeed();
        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'key' => $setting['key'],
            ], $setting);
        }
    }

    public function getDataToSeed(): array
    {
        return [
            [
                'key' => 'address',
                'value' => '123 Street, New York, USA',
            ],
            [
                'key' => 'phone',
                'value' => '+012 345 67890',
            ],
            [
                'key' => 'email',
                'value' => 'info@example.com',
            ],
            [
                'key' => 'facebook',
                'value' => 'https://www.facebook.com/',
            ],
            [
                'key' => 'twitter',
                'value' => 'https://www.twitter.com/',
            ],
            [
                'key' => 'youtube',
                'value' => 'https://www.youtube.com/',
            ],
            [
                'key' => 'linkedin',
                'value' => 'https://www.linkedin.com/',
            ],
        ];
    }
}
