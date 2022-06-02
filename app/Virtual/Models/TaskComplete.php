<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Task Completes",
 *     description="Task Completes",
 *     @OA\Xml(
 *         name="Task Completes"
 *     )
 * )
 */
class TaskComplete
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
     *      title="Document path",
     *      description="Path of document which contain the work",
     *      example="/documents/completes/doc1.dox"
     * )
     *
     * @var string
     */
    public $document_path;

    /**
     * @OA\Property(
     *      title="Task ID",
     *      description="Id of task",
     *      example="14"
     * )
     *
     * @var int
     */
    public $task_id;
}
