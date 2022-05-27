<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $user_id
 * @property $group_id
 * @property $document_path
 */
class Theory extends Model
{
    use HasFactory;

    const ID = 'id';
    const NAME = 'name';
    const USER_ID = 'user_id';
    const GROUP_ID = 'group_id';
    const DOCUMENT_PATH = 'document_path';

    protected $fillable = [
        self::USER_ID,
        self::GROUP_ID,
        self::NAME,
        self::DOCUMENT_PATH
    ];

    protected $appends = [
        'author',
        'date',
        'isAdmin'
    ];

    protected $hidden = [
        'user',
        'group'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
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
}
