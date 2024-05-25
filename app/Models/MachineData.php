<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineData extends Model
{
    use HasFactory;
    protected $table = 'machine_data';

    protected $fillable = [
        'machine_id',
        'machine_name',
        'year',
        'month',
        'week',
        'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->year = $model->year ?? date('Y');
            $model->month = $model->month ?? date('n');
            $model->week = $model->week ?? ceil((date('j') + date('N')) / 7);
            $model->date = $model->date ?? now();
        });
    }

    public function machineOperations()
    {
        return $this->hasMany(MachineOperation::class, 'machine_id');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
