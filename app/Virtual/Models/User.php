<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="User",
 *     description="User",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new user",
     *      example="Roman Gurniy"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email of the new user",
     *      example="roman@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password of the new user",
     *      example="secret123A"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="Image",
     *      description="Path to image on the server",
     *      example="/images/uploads/customer/6244ca3e9c790_logo-nike-1971.png"
     * )
     *
     * @var string
     */
    public $image;
}
