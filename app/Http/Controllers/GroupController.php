<?php

namespace App\Http\Controllers;

use App\Service\GroupService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * @var GroupService
     */
    private $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * @OA\Post(
     *      path="/api/create-group",
     *      operationId="createGroup",
     *      tags={"Groups"},
     *      summary="Create new group",
     *      description="Returns group data",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateGroupRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Group")
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
        ]);
        return $this->groupService->create($data['name']);
    }

    /**
     * @OA\Get(
     *      path="/api/groups",
     *      operationId="getGroupsData",
     *      tags={"Groups"},
     *      summary="Get group information",
     *      description="Returns groups data",
     *      security={{"bearer_token":{}}},
     *         @OA\Parameter(
     *          name="filter",
     *          description="Filter all or my groups",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Group")
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
    public function get(Request $request)
    {
        return $this->groupService->getGroupByFilter($request->get('filter'));
    }

    /**
     * @OA\Post(
     *      path="/api/join-group",
     *      operationId="joinGroup",
     *      tags={"Groups"},
     *      summary="Join to group",
     *      description="Returns success or not",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/JoinGroupRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Group")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Group not found"
     *      ),
     * )
     */
    public function join(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|min:7',
        ]);
        try{
            return $this->groupService->joinGroup($data['code']);
        }catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/delete-group",
     *      operationId="deleteGroup",
     *      tags={"Groups"},
     *      summary="Delete group",
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
     *          description="Group not found"
     *      ),
     * )
     */
    public function delete(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
        ]);
        try{
            $this->groupService->deleteGroup($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
        return response('success');
    }

    /**
     * @OA\Post(
     *      path="/api/left-group",
     *      operationId="leftGroup",
     *      tags={"Groups"},
     *      summary="Left group",
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
     *          description="Group not found"
     *      ),
     * )
     */
    public function left(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
        ]);
        try{
            $this->groupService->leftGroup($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
        return response('success');
    }
}
