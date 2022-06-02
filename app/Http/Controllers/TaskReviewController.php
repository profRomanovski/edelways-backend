<?php

namespace App\Http\Controllers;

use App\Service\TaskService;
use Exception;
use Illuminate\Http\Request;

class TaskReviewController extends Controller
{
    /**
     * @var TaskService
     */
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @OA\Post(
     *      path="/api/review-task",
     *      operationId="reviewTask",
     *      tags={"Reviews"},
     *      summary="Review the task",
     *      description="Returns task data",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ReviewTaskRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskReview")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * )
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'complete_id' => 'required|integer|min:1',
            'mark' => 'required|integer|min:1',
            'comment' => 'nullable|string|max:255|min:3',
        ]);
        try {
            return $this->taskService->reviewTask(
                $data['complete_id'],
                $data['mark'],
                $data['comment']
            );
        } catch (Exception $ex) {
            return response( $ex->getMessage(), 404);
        }
    }
}
