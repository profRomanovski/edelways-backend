<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReview extends Model
{
    use HasFactory;

    const ID = 'id';
    const USER_ID = 'user_id';
    const COMPLETE_ID = 'complete_id';
    const COMMENT = 'comment';
    const MARK = 'mark';

    protected $fillable = [
        self::USER_ID,
        self::COMPLETE_ID,
        self::COMMENT,
        self::MARK
    ];
}
