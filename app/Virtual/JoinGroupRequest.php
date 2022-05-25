<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Join group request",
 *      description="Join group request",
 *      type="object",
 *      required={"code"}
 * )
 */
class JoinGroupRequest
{
    /**
     * @OA\Property(
     *      title="Code",
     *      description="Code of the group",
     *      example="NJHGYTD"
     * )
     *
     * @var string
     */
    public $code;

}
