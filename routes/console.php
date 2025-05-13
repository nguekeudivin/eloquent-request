<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("demo", function(){
  //dump(Permission::pluck('name'));

  $user = User::find("0196c940-4002-7156-90c6-5df4ce33b609");

  dump($user->getPermissions());
});
