<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Render extends Model
{
    const TABLE_NAME = 'frame';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'description',
        'url_demo',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
