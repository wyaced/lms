<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    public function domains()
    {
        return $this->hasMany(Domains::class);
    }
}
