<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Transformers\Admin\PlatformTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Platform extends Model
{
    use HasFactory, HasStatus;

    protected $fillable = [
        'name',
        'logo',
        'order',
        'status',
    ];

    public $modal = "#platform-modal";
    public $transformer = PlatformTransformer::class;


    public function getLogo()
    {
        return Storage::url("platforms/{$this->logo}");
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'platform_id');
    }


    public function getServicesViewClumnSize()
    {
        $services_count = $this->services()->count();
        $class = 'col-lg-12';
        if ($services_count == 2) {
            $class = 'col-lg-6';
        } elseif ($services_count == 3) {
            $class = 'col-lg-4';
        } elseif ($services_count > 3) {
            $class = 'col-lg-3';
        }
        return $class;
    }


    public function getCardId()
    {
        // Mapping of card IDs based on the platform keywords
        $platformCardIds = [
            'google' => 'google-card',
            'instagram' => 'instagram-card',
            'tiktok' => 'tiktok-card',
            'facebook' => 'fb-card',
            'fb' => 'fb-card', // handle short forms
            'pubg' => 'pubg-card',
            'freefire' => 'freefire-card',
            'twitter' => 'twitter-card',
            'snapchat' => 'snapchat-card',
            'telegram' => 'telegram-card',
            // Add more platforms as needed
        ];

        $name_parts = explode(' ' , $this->name);
        // Iterate over the platformCardIds to find a match using strpos
        foreach ($platformCardIds as $keyword => $cardId) {
            foreach($name_parts as $key => $string)
            {
                if (strpos($keyword , strtolower($string)) !== false || strpos($keyword , strtoupper($string)) !== false) {
                    return $cardId;
                }
            }
        }

        // Return null if no match is found
        return $platformCardIds[array_rand($platformCardIds)];
    }
}
