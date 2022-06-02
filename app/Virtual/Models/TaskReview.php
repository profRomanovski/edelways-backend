<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Task Review",
 *     description="Task Reviews",
 *     @OA\Xml(
 *         name="Task Reviews"
 *     )
 * )
 */
class TaskReview
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
     *      title="User ID",
     *      description="Id of user",
     *      example="14"
     * )
     *
     * @var int
     */
    public $user_id;

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
