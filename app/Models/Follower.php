<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Follower extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->is(User::class);
    }

    public function follower()
    {
        return $this->belongsTo(User::class);
    }
}
