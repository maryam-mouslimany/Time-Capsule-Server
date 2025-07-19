<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    function capsules()
    {
        return $this->belongsToMany(Capsule::class, 'capsule_tags', 'tag_id', 'capsule_id');
    }
}
