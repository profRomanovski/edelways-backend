<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Create theory request",
 *      description="Create theory request body data",
 *      type="object",
 *      required={"name", "user_id", "group_id", "document_path"}
 * )
 */
class CreateTheoryRequest
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
     *      title="Group ID",
     *      description="Id of group",
     *      example="12"
     * )
     *
     * @var int
     */
    public $group_id;

    /**
     * @OA\Property(
     *      title="Document path",
     *      description="Path of document on the server",
     *      example="/theory/file.docx"
     * )
     *
     * @var string
     */
    public $document_path;
}
