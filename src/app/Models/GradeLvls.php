<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeLvls extends Model
{
    public function domains()
    {
        return $this->belongsToMany(Domains::class);
    }
}
