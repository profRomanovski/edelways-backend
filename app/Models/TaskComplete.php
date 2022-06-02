<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $user_id
 * @property $task_id
 * @property $document_path
 */
class TaskComplete extends Model
{
    use HasFactory;

    const ID = 'id';
    const USER_ID = 'user_id';
    const TASK_ID = 'task_id';
    const DOCUMENT_PATH = 'document_path';

    protected $fillable = [
        self::USER_ID,
        self::TASK_ID,
        self::DOCUMENT_PATH
    ];

    protected $appends = [
        'document',
        'author',
        'image',
        'date',
        'maxMark',
        'mark',
        'comment'
    ];
    protected $hidden = [
        'user',
        'task'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function getDocumentAttribute()
    {
        return substr($this->document_path, strpos($this->document_path, '_') + 1);
    }

    public function getAuthorAttribute()
    {
        return $this->user->name;
    }

    public function getImageAttribute()
    {
        return $this->user->image;
    }

    public function getDateAttribute()
    {
        return $this->updated_at->format('H:i F j, Y');
    }

    public function getMaxMarkAttribute()
    {
        return $this->task->mark;
    }

    public function getMarkAttribute()
    {
        $review =  TaskReview::query()
            ->where(TaskReview::COMPLETE_ID, '=', $this->id)
            ->first();
        if(!$review){
            return "";
        } else {
            return $review->mark;
        }
    }

    public function getCommentAttribute()
    {
        $review =  TaskReview::query()
            ->where(TaskReview::COMPLETE_ID, '=', $this->id)
            ->first();
        if(!$review){
            return "";
        } else {
            return $review->comment;
        }
    }

}
