<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task",
 *     @OA\Xml(
 *         name="Task"
 *     )
 * )
 */
class Task
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
     *      title="User id",
     *      description="Id of user who created this Task",
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

    /**
     * @OA\Property(
     *      title="Author",
     *      description="Author of Task",
     *      example="Roman Gurniy"
     * )
     *
     * @var string
     */
    public $author;

    /**
     * @OA\Property(
     *      title="Date",
     *      description="Date of created the Task",
     *      example="March 10, 2022"
     * )
     *
     * @var string
     */
    public $date;

    /**
     * @OA\Property(
     *      title="IsAdmin",
     *      description="Returns true is user is admin of this Task",
     *      example="true"
     * )
     *
     * @var string
     */
    public $isAdmin;

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
