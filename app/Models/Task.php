<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

/**
 * @property $id
 * @property $user_id
 * @property $group_id
 * @property $name
 * @property $document_path
 * @property $description
 * @property $mark
 */
class Task extends Model
{
    use HasFactory;

    const ID = 'id';
    const USER_ID = 'user_id';
    const GROUP_ID = 'group_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const DOCUMENT_PATH = 'document_path';
    const MARK = 'mark';

    protected $fillable = [
        self::GROUP_ID,
        self::USER_ID,
        self::DOCUMENT_PATH,
        self::NAME,
        self::DESCRIPTION,
        self::MARK
    ];

    protected $appends = [
        'author',
        'date',
        'isAdmin',
        'complete',
        'comments'
    ];

    protected $hidden = [
        'user',
        'group',
        'taskCompletes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function completes()
    {
        return $this->hasMany(TaskComplete::class);
    }

    public function getCompleteAttribute()
    {
        return $this->completes()
            ->where(TaskComplete::USER_ID, '=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function getAuthorAttribute()
    {
        return $this->user->name;
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('F j, Y');
    }

    public function getIsAdminAttribute(): bool
    {
        $group = Group::query()->find($this->group_id);
        if($group->isAdmin){
            return true;
        } else {
            return false;
        }
    }

    public function getCommentsAttribute()
    {
        $key = 1;
        if(!$this->complete && !$this->group->isAdmin){
            return [];
        }
        $comments = [];
        if($this->group->isAdmin){
            $completes = $this->completes()
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $completes = $this->completes()
                ->where(TaskComplete::USER_ID, '=', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();
        }
        foreach ($completes as $complete){
            $review = TaskReview::query()->
                where(TaskReview::COMPLETE_ID, '=', $complete->id)
                ->first();
            if($review){
                $comment = [
                    'type' => 'review',
                    'key' => $key,
                    'data' => $review
                ];
                $comments[] = $comment;
                $key++;
            }
            $comment = [
                'type' => 'complete',
                'key' => $key,
                'data' => $complete,
            ];
            $comments[] = $comment;
            $key++;
        }
        return $comments;
    }
}
