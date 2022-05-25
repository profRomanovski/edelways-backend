<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Delete request",
 *      description="Delete group request body data",
 *      type="object",
 *      required={"id"}
 * )
 */
class DeleteGroupRequest
{
    /**
     * @OA\Property(
     *      title="Id",
     *      description="Id of the group",
     *      example="3"
     * )
     *
     * @var int
     */
    public $id;
}
