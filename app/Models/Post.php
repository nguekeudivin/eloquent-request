<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{

    protected $fillable = [
        "title",
        "slug",
        "body",
        "is_publised"
    ];

    // post:list

    // post:list:owner
    // post:list:public
    // post:list:published


    public static function queryFilters(): array
    {
        return [
            'owner' => function (Builder $query, $user) {
                if ($user) {
                    $query->where('user_id', $user->id);
                }
            },
            'published' => function (Builder $query, $user) {
                $query->where('is_published', false);
            },

        ];
    }
}
