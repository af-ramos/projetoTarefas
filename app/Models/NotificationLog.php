<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class NotificationLog extends Model
{
    protected $connection = 'mongodb';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'time',
        'user',
        'type',
        'body'
    ];
}
