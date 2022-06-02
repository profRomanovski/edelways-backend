<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Create Task request",
 *      description="Create Task request body data",
 *      type="object",
 *      required={"name", "user_id", "group_id", "description"}
 * )
 */
class CreateTaskRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new Task",
     *      example="Java exam"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the new Task",
     *      example="Pass the exam"
     * )
     *
     * @var string
     */
    public $description;

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

    /**
     * @OA\Property(
     *     title="Mark",
     *     description="Max mark",
     *     format="int64",
     *     example=12
     * )
     *
     * @var integer
     */
    private $mark;
}
