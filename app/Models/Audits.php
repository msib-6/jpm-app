<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audits extends Model
{
    USE hasFactory;
    protected $table = 'audits';

   protected $guarded;

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
