<?php

namespace App\Services\QueryService;

/**
 * @OA\Schema(
 *     schema="QuerySchema",
 *     type="object",
 *     title="Query Schema",
 *     description="Schema for query parameters",
 *     @OA\Property(
 *         property="field1",
 *         type="string",
 *         description="The first field, required and must be a string",
 *         example="example_value"
 *     )
 * )
 */
class QuerySchema
{
    // Your class logic here
}
