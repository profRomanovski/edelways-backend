<?php

namespace App\Service;

use App\Models\Group;
use App\Models\Task;
use App\Models\TaskComplete;
use App\Models\TaskReview;
use Exception;

class TaskService
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
     * @throws Exception
     */
    public function getTasksList($groupId)
    {
        $group = Group::query()->find($groupId);
        $this->groupService->validate($group);
        return Task::query()
            ->where(Task::GROUP_ID, '=', $groupId)
            ->get();
    }

    /**
     * @throws Exception
     */
    public function createTask($name, $groupId, $description, $documentPath, $mark)
    {
        $userId = auth()->user()->id;
        $group = Group::query()->find($groupId);
        $this->groupService->validate($group);
        return Task::query()->create([
            Task::NAME => $name,
            Task::GROUP_ID => $groupId,
            Task::DESCRIPTION => $description,
            Task::DOCUMENT_PATH => $documentPath,
            Task::USER_ID => $userId,
            Task::MARK => $mark
        ]);
    }

    /**
     * @throws Exception
     */
    public function get($id)
    {
        $task = Task::query()->find($id);
        $this->validateTask($task);
        return $task;
    }

    /**
     * @throws Exception
     */
    public function completeTask($task_id, $document_path)
    {
        $task = Task::query()->find($task_id);
        $this->validateTask($task);
        if(!$task->complete || $task->complete->mark != ""){
            return TaskComplete::query()->create([
                TaskComplete::TASK_ID => $task_id,
                TaskComplete::USER_ID => auth()->id(),
                TaskComplete::DOCUMENT_PATH => $document_path
            ]);
        } else{
            $task->complete->update([
                TaskComplete::DOCUMENT_PATH => $document_path
            ]);
            return $task->complete;
        }

    }

    /**
     * @throws Exception
     */
    public function getCompleteList($task_id): array
    {
        $task = Task::query()->find($task_id);
        $this->validateTask($task);
        $userList = [];
        $completes = [];
        $allCompletes = $task->completes()->orderBy('created_at', 'desc')->get();
        foreach ($allCompletes as $complete) {
            if (!key_exists($complete->user_id, $userList)) {
                $userList[$complete->user_id] = 1;
                $completes[] = $complete;
            }
        }
        return $completes;
    }

    /**
     * @throws Exception
     */
    public function getComplete($id)
    {
        $complete = TaskComplete::query()->find($id);
        if (!$complete) {
            throw new Exception('Роботу не знайдено');
        }
        $task = Task::query()->find($complete->task_id);
        $this->validateTask($task);
        return $complete;
    }

    /**
     * @throws Exception
     */
    public function reviewTask($complete_id, $mark, $comment)
    {
        $complete = TaskComplete::query()->find($complete_id);
        if (!$complete) {
            throw new Exception('Роботу не знайдено');
        }
        $this->validateTask($complete->task);
        $review = TaskReview::query()->where(TaskReview::COMPLETE_ID, '=', $complete_id)
            ->first();
        if (!$review) {
            return TaskReview::query()->create([
                TaskReview::USER_ID => auth()->id(),
                TaskReview::COMPLETE_ID => $complete_id,
                TaskReview::COMMENT => $comment,
                TaskReview::MARK => $mark
            ]);
        } else {
             $review->update([
                TaskReview::COMMENT => $comment,
                TaskReview::MARK => $mark
            ]);
            return $review;
        }
    }

    /**
     * @throws Exception
     */
    public function validateTask($task)
    {
        if (!$task) {
            throw new Exception('Завдання не знайдено');
        }
        $group = Group::query()->find($task->group_id);
        $this->groupService->validate($group);
    }

}
