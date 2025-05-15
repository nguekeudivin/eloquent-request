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

  dump(Permission::where('resource','conversation_participant')->get()->pluck('name'));
});
