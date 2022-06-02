<?php

namespace App\Service;

use App\Models\Group;
use App\Models\Theory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TheoryService
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
     * @param $name
     * @param $groupId
     * @param $documentPath
     * @return Builder|Model
     * @throws Exception
     */
    public function createTheory($name, $groupId, $documentPath)
    {
        $userId = auth()->user()->id;
        $group = Group::query()->find($groupId);
        $this->groupService->validate($group);
        return Theory::query()->create([
           Theory::NAME => $name,
           Theory::GROUP_ID => $groupId,
           Theory::DOCUMENT_PATH => $documentPath,
           Theory::USER_ID => $userId
        ]);
    }

    /**
     * @throws Exception
     */
    public function getTheoryList($groupId)
    {
        $group = Group::query()->find($groupId);
        $this->groupService->validate($group);
        return Theory::query()
            ->where(Theory::GROUP_ID, '=', $groupId)
            ->get();
    }

    /**
     * @throws Exception
     */
    public function get($id)
    {
        $theory = Theory::query()->find($id);
        $this->validate($theory);
        return $theory;
    }

    /**
     * @throws Exception
     */
    public function deleteTheory($id)
    {
        $theory = Theory::query()->find($id);
        $this->validate($theory);
        $theory->delete();
    }

    /**
     * @throws Exception
     */
    public function validate($theory)
    {
        if(!$theory){
            throw new Exception('Теорію не знайдено');
        }
        $this->groupService->validate($theory->group);
    }
}
