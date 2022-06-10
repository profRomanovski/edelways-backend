<?php

namespace App\Service;

use App\Models\Group;
use App\Models\GroupUsers;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GroupService
{
    /**
     * @param string $name
     * @return Builder|Model
     */
    public function create(string $name)
    {
        $userId = auth()->user()->id;
        $code = $this->generateRandomString();
        return Group::query()->create([
            Group::NAME => $name,
            Group::USER_ID => $userId,
            Group::CODE => $code
        ]);
    }

    public function generateRandomString($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getGroupByFilter($filter)
    {
        $groups = [];
        $userId = auth()->user()->id;
        switch ($filter){
            case "my": {
                $groups = Group::query()
                    ->where(Group::USER_ID, '=', $userId)
                    ->get();
                break;
            }
            case "all": {
                $groupUsers = GroupUsers::query()
                    ->where(GroupUsers::USER_ID, '=',$userId)
                    ->get();

                $groupIds = [];
                foreach ($groupUsers as $groupUser){
                    $groupIds[] = $groupUser->group_id;
                }
                $groups = Group::query()
                    ->whereIn(Group::ID, $groupIds)
                    ->get();
                break;
            }
            default: {

            }

        }
       return $groups;
    }

    /**
     * @throws Exception
     */
    public function joinGroup($groupCode)
    {
        $userId = auth()->user()->id;
        $group = Group::query()
            ->where('code', '=', $groupCode)
            ->first();
        if(is_null($group)){
            throw new Exception('Не вдалось знайти групу');
        }
        $groupUser = GroupUsers::query()
            ->where(GroupUsers::USER_ID, '=',$userId)
            ->where(GroupUsers::GROUP_ID, '=', $group->id)
            ->first();
        if(!is_null($groupUser)) {
            throw new Exception('Користувач вже приєднаний до цієї групи');
        }
        return GroupUsers::query()
            ->create([
                GroupUsers::GROUP_ID => $group->id,
                GroupUsers::USER_ID => $userId
            ]);
    }

    /**
     * @throws Exception
     */
    public function deleteGroup(int $id)
    {
        $group = Group::query()->find($id);
        if(!$group){
            throw new Exception("Дана група не існує");
        }
        $group->delete();
    }

    /**
     * @throws Exception
     */
    public function leftGroup(int $id)
    {
        $group = Group::query()->find($id);
        $this->validate($group);

        $groupUser = GroupUsers::query()
            ->where(GroupUsers::GROUP_ID, '=', $id)
            ->where(GroupUsers::USER_ID,'=', auth()->user()->id)
            ->first();
        $groupUser->delete();
    }

    /**
     * @throws Exception
     */
    public function leftUserFromGroup($user_id, $group_id)
    {
        $group = Group::query()->find($group_id);
        $this->validate($group);
        $groupUser = GroupUsers::query()
            ->where(GroupUsers::GROUP_ID, '=', $group_id)
            ->where(GroupUsers::USER_ID,'=', $user_id)
            ->first();
        $groupUser->delete();
    }

    /**
     * @throws Exception
     */
    public function get($id)
    {
        $group = Group::query()->find($id);
        $this->validate($group);
        return $group;
    }

    /**
     * @throws Exception
     */
    public function validate($group)
    {
        if(!$group){
            throw new Exception("Групу не знайдено");
        }
        if(!$group->canAccess && !$group->isAdmin){
            throw new Exception("Ви не входите в цю групу");
        }
    }
}
