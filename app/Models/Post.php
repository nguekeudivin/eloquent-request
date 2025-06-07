<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function queryFilters()
    {
        return [
            'mine' => function (Builder $query, $user) {
                $query->where('user_id', $user->id)->where('id', '<', 3)->get();
            }
        ];
    }
}
