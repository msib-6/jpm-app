<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    USE hasFactory;
    protected $table = 'audit';

    protected $fillable = [
        'user_id',
        'machine_operation_id',
        'event',
        'timestamp',
        'changes',
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function machineOperation()
    {
        return $this->belongsTo(MachineOperation::class);
    }
}
