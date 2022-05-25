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
}
