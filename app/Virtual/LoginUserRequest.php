<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Login user request",
 *      description="Login user request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginUserRequest
{
    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email of the user",
     *      example="roman@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password of the user",
     *      example="secret123A"
     * )
     *
     * @var string
     */
    public $password;
}
