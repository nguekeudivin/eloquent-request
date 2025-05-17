<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\User;
use App\Models\Adhesion;
use App\Models\Cotisation;
use App\Models\PriseEnCharge;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("demo", function(){
  //dump(Permission::pluck('name'));

  $modelSingulier = french_singular(Str::replace('-','_','user-models'));

  foreach(Adhesion::all() as $item){
    $item->update(['date_debut' => '2025-01-01']);
  }


  $items = PriseEnCharge::where('mutualiste_id',"0196db4a-0158-7316-ae5f-0d5e9aff672d")->get();

  dump($items);
});
