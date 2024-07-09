<?php
namespace App\Traits;
trait HasStatus
{
    public function scopeStatus($query  , $status)
    {
        return $query->where('status' , $status);
    }

}
