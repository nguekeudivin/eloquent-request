<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusTypeController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MutualisteController;
use App\Http\Controllers\FonctionMutualisteController;
use App\Http\Controllers\GroupeMutualisteController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\AyantDroitController;
use App\Http\Controllers\TypeAyantDroitController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\CategorieEntreeController;
use App\Http\Controllers\CategorieSortieController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\SortieController;
use App\Http\Controllers\TypeAllocationController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\RestrictionPrestationController;
use App\Http\Controllers\TypePrestationController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\ModaliteRemboursementController;
use App\Http\Controllers\PriseEnChargeController;
use App\Http\Controllers\RemboursementController;
use App\Http\Controllers\RéclamationController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationParticipantController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\RolePermissionController;


$endpoints = ['store', 'update', 'destroy'];

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () use($endpoints){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'me']);

    Route::post('query',[QueryController::class,'index']);

    Route::resource('status-types', StatusTypeController::class)->only($endpoints);
    Route::resource('roles', RoleController::class)->only($endpoints);
    Route::resource('notifications', NotificationController::class)->only($endpoints);
    Route::resource('admins', AdminController::class)->only($endpoints);
    Route::resource('mutualistes', MutualisteController::class)->only($endpoints);
    Route::resource('groupe-mutualistes', GroupeMutualisteController::class)->only($endpoints);
    Route::resource('contrats',ContratController::class)->only($endpoints);
    Route::resource('ayant-droits', AyantDroitController::class)->only($endpoints);
    Route::resource('caisses', CaisseController::class)->only($endpoints);
    Route::resource('categorie-entrees', CategorieEntreeController::class)->only($endpoints);
    Route::resource('categorie-sorties', CategorieSortieController::class)->only($endpoints);
    Route::resource('entrees', EntreeController::class)->only($endpoints);
    Route::resource('sorties', SortieController::class)->only($endpoints);
    Route::resource('type-allocations', TypeAllocationController::class)->only($endpoints);
    Route::resource('allocations', AllocationController::class)->only($endpoints);
    Route::resource('restriction-prestations', RestrictionPrestationController::class)->only($endpoints);
    Route::resource('type-prestations', TypePrestationController::class)->only($endpoints);
    Route::resource('prestations', PrestationController::class)->only($endpoints);
    Route::resource('modalite-remboursements', ModaliteRemboursementController::class)->only($endpoints);
    Route::resource('prises-en-charge', PriseEnChargeController::class)->only($endpoints);
    Route::resource('remboursements', RemboursementController::class)->only($endpoints);
    Route::resource('reclamations', RéclamationController::class)->only($endpoints);
    Route::resource('conversations', ConversationController::class)->only($endpoints);
    Route::resource('messages', MessageController::class)->only($endpoints);
    Route::resource('cotisations', CotisationController::class)->only($endpoints);
    Route::resource('users', UserController::class)->only($endpoints);


    Route::patch('/notifications/{userId}/read-all', [NotificationController::class,'readAll']);

    Route::resource('fonction-mutualistes', FonctionMutualisteController::class)->only($endpoints);
    Route::resource('ayant-droit-types', TypeAyantDroitController::class)->only($endpoints);
});
