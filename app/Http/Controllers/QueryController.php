<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QueryService\Query;
use App\Services\QueryService\PermissionEvaluator;
use App\Services\QueryService\EloquentQueryBuilder;
use App\Services\QueryService\QueryRunner;
use Exception;

class QueryController extends Controller
{

    protected $queryService;

    public function __construct(Query $queryService)
    {
        $this->queryService = $queryService;
    }

    public function index(Request $request)
    {

        $user = $request->user();
        if($user == null){
            return response()->json(['message' => 'Unauthorize'], 422);
        }

        // Register models.
       $this->queryService->setModels([
            "user" => \App\Models\User::class,
            "post" => \App\Models\Post::class,
            "notification" => \App\Models\Notification::class,
            "admin" => \App\Models\Admin::class,
            "role" => \App\Models\Role::class,
            "mutualiste" => \App\Models\Mutualiste::class,
            'contrat' => \App\Models\Contrat::class,
            'groupe_mutualiste' => \App\Models\GroupeMutualiste::class,
            'fonction_mutualiste' => \App\Models\FonctionMutualiste::class,
            'type_ayant_droit' => \App\Models\TypeAyantDroit::class,
            'type_allocation' => \App\Models\TypeAllocation::class,
            'ayant_droit' => \App\Models\AyantDroit::class,
            'adhesion' => \App\Models\Adhesion::class,
            'cotisation' => \App\Models\Cotisation::class,
            'categorie_sortie' => \App\Models\CategorieSortie::class,
            'groupe_allocation' => \App\Models\GroupeAllocation::class,
            'conversation_participant' => \App\Models\ConversationParticipant::class,
            'conversation' => \App\Models\Conversation::class,
            'message' => \App\Models\Message::class,
            'caisse' => \App\Models\Caisse::class,
            'categorie_entree' => \App\Models\CategorieEntree::class,
            'entree' => \App\Models\Entree::class,
            'sortie' => \App\Models\Sortie::class,
            'allocation' => \App\Models\Allocation::class,
            'restriction_prestation' => \App\Models\RestrictionPrestation::class,
            'type_prestation' => \App\Models\TypePrestation::class,
            'modalite_remboursement' => \App\Models\ModaliteRemboursement::class,
            'remboursement' => \App\Models\Remboursement::class,
            'reclamation' => \App\Models\Réclamation::class,
            'user_role' => \App\Models\UserRole::class,
            'role_permission' => \App\Models\RolePermission::class,
            'status_type' => \App\Models\StatusType::class,
            'prise_en_charge' => \App\Models\PriseEnCharge::class
        ]);

        return response()->json($this->queryService->run($user));
    }
}
