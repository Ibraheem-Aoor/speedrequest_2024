<?php

namespace App\Models;

use App\Transformers\Admin\OrderTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'service_id',
        'profile',
        'has_completed_cpa',
    ];


    public $transformer = OrderTransformer::class;
    public $modal = '#order-modal';

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class , 'service_id');
    }

    public function scopeWithProfile($query)
    {
        return $query->whereNotNull('profile');
    }
    public function scopeWithoutProfile($query)
    {
        return $query->whereNull('profile');
    }
}
