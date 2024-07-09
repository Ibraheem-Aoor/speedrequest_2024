<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory , HasStatus;
    protected $fillable = [
                'name' ,
                'features',
                'platform_id',
                'offer_url',
                'is_published',
                'task_title',
                'status',
    ];



    public function platform() : BelongsTo
    {
        return $this->belongsTo(Platform::class , 'platform_id');
    }

}
