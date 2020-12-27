<?php

namespace Alish\ActiveableModel\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon created_at
 * @property bool is_active
 */
class ActiveableModel extends Model
{
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'status' => 'bool'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ActiveableModel $status) {
            $status->created_at = $status->freshTimestamp();
        });
    }

    public function object()
    {
        return $this->morphTo();
    }
}
