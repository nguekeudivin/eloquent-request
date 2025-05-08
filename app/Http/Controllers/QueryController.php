<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QueryService\MainQuery;
use Exception;

class QueryController extends Controller
{

    public function index(Request $request)
    {

        return response()->json((new MainQuery)->run($request));

    }
}
