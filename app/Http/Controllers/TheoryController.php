<?php

namespace App\Http\Controllers;

use App\Service\TheoryService;
use Exception;
use Illuminate\Http\Request;

class TheoryController extends Controller
{
    /**
     * @var TheoryService
     */
    private $theoryService;

    public function __construct(TheoryService $theoryService)
    {
        $this->theoryService = $theoryService;
    }

    /**
     * @OA\Post(
     *      path="/api/create-theory",
     *      operationId="createTheory",
     *      tags={"Theories"},
     *      summary="Create new theory",
     *      description="Returns theory data",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateTheoryRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Theory")
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
            'group_id' => 'required|integer|min:1',
            'document_path' => 'required|string|max:255|min:3',
        ]);
        return $this->theoryService->createTheory(
            $data['name'],
            $data['group_id'],
            $data['document_path']
        );
    }

    /**
     * @OA\Get(
     *      path="/api/theories",
     *      operationId="getTheoriesData",
     *      tags={"Theories"},
     *      summary="Get theories list",
     *      description="Returns theories list",
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
    public function list(Request $request)
    {
        $data = $request->validate([
            'group_id' => 'required|integer|min:1',
        ]);
        try{
            return $this->theoryService->getTheoryList($data['group_id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/theory",
     *      operationId="getTheoryData",
     *      tags={"Theories"},
     *      summary="Get theory information",
     *      description="Returns theory data",
     *      security={{"bearer_token":{}}},
     *         @OA\Parameter(
     *          name="id",
     *          description="Theory id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Group")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Theory not found"
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
            return $this->theoryService->get($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/delete-theory",
     *      operationId="deleteTheory",
     *      tags={"Theories"},
     *      summary="Delete theory",
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
     *          description="Theory not found"
     *      ),
     * )
     */
    public function delete(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
        ]);
        try{
            $this->theoryService->deleteTheory($data['id']);
        } catch (Exception $ex){
            return response( $ex->getMessage(), 404);
        }
        return response('success');
    }

}
