<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasteryBatchUpdateLog extends Model
{
    protected $fillable = [
        'status',
        'error',
        'started_at',
        'finished_at',
    ];
}
