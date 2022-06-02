<?php

namespace App\Http\Controllers;

use App\Service\TaskService;
use Exception;
use Illuminate\Http\Request;

class CompleteController extends Controller
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
     *      path="/api/complete-task",
     *      operationId="completeTask",
     *      tags={"Completes"},
     *      summary="Complete the task",
     *      description="Returns task data",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CompleteTaskRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskComplete")
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
            'task_id' => 'required|integer|min:1',
            'document_path' => 'nullable|string|max:255|min:3',
        ]);
        try {
            return $this->taskService->completeTask(
                $data['task_id'],
                $data['document_path'],
            );
        } catch (Exception $ex) {
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/completes",
     *      operationId="getTasksCompletes",
     *      tags={"Completes"},
     *      summary="Get completes list",
     *      description="Returns completes list",
     *      security={{"bearer_token":{}}},
     *         @OA\Parameter(
     *          name="task_id",
     *          description="Id of related task",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskComplete")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    public function list(Request $request)
    {
        $data = $request->validate([
            'task_id' => 'required|integer|min:1',
        ]);
        try{
            return $this->taskService->getCompleteList($data['task_id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/complete",
     *      operationId="getCompleteData",
     *      tags={"Completes"},
     *      summary="Get complete information",
     *      description="Returns complete data",
     *      security={{"bearer_token":{}}},
     *         @OA\Parameter(
     *          name="id",
     *          description="Complete id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskComplete")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Task not found"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    public function get(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
        ]);
        try{
            return $this->taskService->getComplete($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }
}
