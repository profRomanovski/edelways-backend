<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Create group request",
 *      description="Create group request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class CreateGroupRequest
{
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
}
