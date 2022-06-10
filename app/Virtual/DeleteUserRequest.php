<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Delete request",
 *      description="Delete user from group request body data",
 *      type="object",
 *      required={"user_id", "group_id"}
 * )
 */
class DeleteUserRequest
{
    /**
     * @OA\Property(
     *      title="Group id",
     *      description="Id of the group",
     *      example="3"
     * )
     *
     * @var int
     */
    public $group_id;

    /**
     * @OA\Property(
     *      title="User id",
     *      description="Id of the user",
     *      example="4"
     * )
     *
     * @var int
     */
    public $user_id;
}
