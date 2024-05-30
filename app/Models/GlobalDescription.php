<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalDescription extends Model
{
    protected $table = 'global_descriptions';

    protected $fillable = [
        'year',
        'month',
        'week',
        'description',
        'line',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->year = $model->year ?? date('Y');
            $model->month = $model->month ?? date('n');
            $model->week = $model->week ?? ceil((date('j') + date('N')) / 7);
        });
    }
}

