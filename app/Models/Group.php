<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $name
 * @property $code
 * @property $user_id
 * @property $id
 * @property $canAccess
 * @property $isAdmin
 */
class Group extends Model
{
    use HasFactory;

    const ID = 'id';
    const NAME = 'name';
    const CODE = 'code';
    const USER_ID = 'user_id';

    protected $table = 'groups';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        self::NAME,
        self::CODE,
        self::USER_ID
    ];

    protected $hidden = [
        'user'
    ];

    protected $appends = [
        'users',
        'author',
        'authorImage',
        'authorEmail',
        'isAdmin',
        'canAccess',
        'userList',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsersAttribute(): int
    {
        return GroupUsers::query()
            ->where(GroupUsers::GROUP_ID, '=', $this->id)
            ->count() + 1;
    }

    public function getAuthorAttribute()
    {
        return $this->user->name;
    }

    public function getAuthorEmailAttribute()
    {
        return $this->user->email;
    }

    public function getAuthorImageAttribute()
    {
        return $this->user->image;
    }

    public function getIsAdminAttribute(): bool
    {
        $isAdmin = false;
        if($this->user_id === auth()->user()->id){
            $isAdmin = true;
        }
        return $isAdmin;
    }

    public function getDateAttribute()
    {
        return $this->updated_at->format('H:i F j, Y');
    }

    public function getCanAccessAttribute(): bool
    {
        $canAccess = false;
        $groupUser = GroupUsers::query()
            ->where(GroupUsers::GROUP_ID,'=',$this->id)
            ->where(GroupUsers::USER_ID, '=', auth()->user()->id)
            ->first();
        if($groupUser){
            $canAccess = true;
        }
        return $canAccess;
    }

    public function getUserListAttribute()
    {
        return GroupUsers::query()
        ->where(GroupUsers::GROUP_ID, '=', $this->id)
        ->get();
    }
}
