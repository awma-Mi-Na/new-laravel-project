<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserFollower
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserFollower extends Model
{
    use HasFactory;
}
