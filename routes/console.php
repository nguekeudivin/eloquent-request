<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\Helpers;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use App\Models\Permission;
use App\Models\User;
use App\Models\Post;

class MyClass
{
    public function sayHello($name)
    {
        return "Hello, $name!";
    }
}

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("demo", function () {

    $query = Post::select('user_id', 'title')->get()->groupBy('user_id');

    // $query->get();

    // $query->groupBy("user_id");

    dump($query->toArray());
});
