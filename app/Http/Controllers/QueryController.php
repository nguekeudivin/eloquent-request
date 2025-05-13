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
            "notification" => \App\Models\Notification::class
        ]);

        return response()->json($this->queryService->run($user));
    }
}
