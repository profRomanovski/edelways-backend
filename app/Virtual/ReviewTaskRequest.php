<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Review Task request",
 *      description="Review Task request body data",
 *      type="object",
 *      required={"complete_id", "comment", "mark"}
 * )
 */
class ReviewTaskRequest
{
    /**
     * @OA\Property(
     *      title="Complete ID",
     *      description="Id of Complete task",
     *      example="14"
     * )
     *
     * @var int
     */
    public $complete_id;

    /**
     * @OA\Property(
     *      title="Mark",
     *      description="Mark of Complete task",
     *      example="6"
     * )
     *
     * @var int
     */
    public $mark;

    /**
     * @OA\Property(
     *      title="Comment",
     *      description="Comment for task",
     *      example="Great work!"
     * )
     *
     * @var string
     */
    public $comment;
}
