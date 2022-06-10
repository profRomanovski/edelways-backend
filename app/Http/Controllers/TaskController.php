<?php

namespace App\Http\Controllers;

use App\Service\TaskService;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
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
     * @OA\Get(
     *      path="/api/tasks",
     *      operationId="getTasksData",
     *      tags={"Tasks"},
     *      summary="Get tasks list",
     *      description="Returns tasks list",
     *      security={{"bearer_token":{}}},
     *         @OA\Parameter(
     *          name="group_id",
     *          description="Id of related group",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
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
            'group_id' => 'required|integer|min:1',
        ]);
        try{
            return $this->taskService->getTasksList($data['group_id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/create-task",
     *      operationId="createTask",
     *      tags={"Tasks"},
     *      summary="Create new task",
     *      description="Returns task data",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateTaskRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
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
            'name' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:3',
            'group_id' => 'required|integer|min:1',
            'mark' => 'required|integer|min:1',
            'document_path' => 'nullable|string|max:255|min:3',
        ]);
        try {
            return $this->taskService->createTask(
                $data['name'],
                $data['group_id'],
                $data['description'],
                $data['document_path'],
                $data['mark']
            );
        } catch (Exception $ex) {
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/task",
     *      operationId="getTaskData",
     *      tags={"Tasks"},
     *      summary="Get task information",
     *      description="Returns task data",
     *      security={{"bearer_token":{}}},
     *         @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
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
            return $this->taskService->get($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/delete-task",
     *      operationId="deleteTask",
     *      tags={"Tasks"},
     *      summary="Delete task",
     *      description="Returns success",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/DeleteGroupRequest")
     *      ),
     *     @OA\Response(
     *        response=200,
     *        description="Success",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Task not found"
     *      ),
     * )
     */
    public function delete(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
        ]);
        try{
            $this->taskService->deleteTask($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
        return response('success');
    }
}
