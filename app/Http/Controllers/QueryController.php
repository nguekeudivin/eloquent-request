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

        $userPermissions = [
            //'post:list',
            'post.id',
            'post.title',
            'post:list:published',
            //'post.*',
            //'user:list',
            //'user.*',
            //'user:list:verified',
            //'user:list:recent',
            'user.name',
            'user.email'
        ];

        $this->queryService->setModels([
            "user" => \App\Models\User::class,
            "post" => \App\Models\Post::class
        ]);

        return response()->json($this->queryService->run($request, $userPermissions));

    }
}
