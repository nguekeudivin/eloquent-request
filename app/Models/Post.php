<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{


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
            'latest' => function (Builder $query, $user) {
                $query->orderBy('created_at', 'desc')->limit(5);
            },
        ];
    }
}
