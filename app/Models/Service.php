<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Transformers\Admin\ServiceTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory, HasStatus;
    protected $fillable = [
        'image',
        'name',
        'features',
        'platform_id',
        'offer_url',
        'task_title',
        'status',
    ];



    public $modal = '#service-modal';
    public $transformer = ServiceTransformer::class;



    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

}
