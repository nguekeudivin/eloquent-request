<?php
namespace App\Services\QueryService;

class MainQuery extends Query
{
    protected $models = [
        "user" => \App\Models\User::class,
        "post" => \App\Models\Post::class
    ];
}
