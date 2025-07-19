<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Capsule extends Model
{
        use HasFactory;
        function tags()
        {
                return $this->belongsToMany(Tag::class, 'capsule_tags', 'capsule_id', 'tag_id');
        }
        function user()
        {
                return $this->belongsTo(User::class);
        }
}
