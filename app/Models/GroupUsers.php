<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    use HasFactory;

    const ID = 'id';
    const GROUP_ID = 'group_id';
    const USER_ID = 'user_id';

    protected $table = 'group_users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        self::GROUP_ID,
        self::USER_ID
    ];

    protected $appends = [
        'userName',
        'userEmail',
        'userImage',
        'date'
    ];

    public function getUserNameAttribute()
    {
        return User::query()->find($this->user_id)->name;
    }

    public function getUserEmailAttribute()
    {
        return User::query()->find($this->user_id)->email;
    }

    public function getUserImageAttribute()
    {
        return User::query()->find($this->user_id)->image;
    }

    public function getDateAttribute()
    {
        return $this->updated_at->format('H:i F j, Y');
    }
}
