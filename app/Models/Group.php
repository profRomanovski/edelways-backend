<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $name
 * @property $code
 * @property $user_id
 * @property $id
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
        'author'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsersAttribute(): int
    {
        return 12;
    }

    public function getAuthorAttribute()
    {
        return $this->user->name;
    }
}
