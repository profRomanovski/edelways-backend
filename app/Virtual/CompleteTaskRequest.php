<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Complete Task request",
 *      description="Complete Task request body data",
 *      type="object",
 *      required={"task_id", "document_path"}
 * )
 */
class CompleteTaskRequest
{
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
