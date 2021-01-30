<?php

namespace Nanuc\LaravelTokenable\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['type', 'expires_at', 'token'];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function tokenable()
    {
        return $this->morphTo('model');
    }
}