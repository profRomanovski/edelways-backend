<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Group",
 *     description="Group",
 *     @OA\Xml(
 *         name="Group"
 *     )
 * )
 */
class Group
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
     *      description="Name of the new group",
     *      example="Java"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Code",
     *      description="Random code to connect to group",
     *      example="GHDFDBU"
     * )
     *
     * @var string
     */
    public $code;

    /**
     * @OA\Property(
     *      title="User id",
     *      description="Id of user who created this group",
     *      example="23"
     * )
     *
     * @var string
     */
    public $user_id;

    /**
     * @OA\Property(
     *      title="Users",
     *      description="Count of joined uses",
     *      example="12"
     * )
     *
     * @var int
     */
    public $users;

    /**
     * @OA\Property(
     *      title="Author",
     *      description="Name of author",
     *      example="Roman Gurniy"
     * )
     *
     * @var string
     */
    public $author;
}
