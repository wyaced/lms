<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    public function topic()
    {
        return $this->belongsTo(Topics::class);
    }
}
