<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $user_id
 * @property $group_id
 * @property $name
 * @property $document_path
 * @property $description
 */
class Task extends Model
{
    use HasFactory;

    const ID = 'id';
    const USER_ID = 'user_id';
    const GROUP_ID = 'group_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const DOCUMENT_PATH = 'document-path';

    protected $fillable = [
        self::GROUP_ID,
        self::USER_ID,
        self::DOCUMENT_PATH,
        self::NAME,
        self::DESCRIPTION
    ];


}
