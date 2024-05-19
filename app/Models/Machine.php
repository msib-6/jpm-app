<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;
    protected $table = 'machines';

    protected $fillable = [
        'machine_name',
        'category',
        'line',
    ];

    protected $casts = [
        'line' => 'array',
    ];

    public function machineOperations()
    {
        return $this->hasMany(MachineOperation::class);
    }
}
