<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\User;
use App\Models\Adhesion;
use App\Services\Helpers;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;

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

    $modelClass = 'App\Models\User';

    $user = new $modelClass();

    dd($user->rels);
});
