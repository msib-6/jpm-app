<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineOperation extends Model
{
    use HasFactory;
    protected $table = 'machine_operations';

    protected $fillable = [
        'machine_id',
        'year',
        'month',
        'week',
        'day',
        'code',
        'time',
        'description',
        'is_changed',
        'changed_by',
        'change_date',
        'is_approved',
        'approved_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Custom validation for unique time/day combination
            $existingOperation = self::where('machine_id', $model->machine_id)
                ->where('time', $model->time)
                ->where('day', $model->day)
                ->first();

            if ($existingOperation) {
                throw new \Exception('Operation with the same time and day already exists');
            }
        });
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
