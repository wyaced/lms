<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    public function gradeLvls()
    {
        return $this->belongsToMany(GradeLvls::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function topics()
    {
        return $this->hasMany(Topics::class);
    }
}
