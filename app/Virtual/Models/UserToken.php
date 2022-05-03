<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="User Token",
 *     description="User token for auth",
 *     @OA\Xml(
 *         name="Token"
 *     )
 * )
 */
class UserToken
{
    /**
     * @OA\Property(
     *      title="Token",
     *      description="Token for auth",
     *      example="5|tUA9GsFtBSNjZFq3rxYXb3BAk9A44NmBha7rl7iB"
     * )
     *
     * @var string
     */
    public $token;
}
