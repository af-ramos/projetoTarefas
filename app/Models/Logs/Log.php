<?php

namespace App\Models\Logs;

use MongoDB\Laravel\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'mongodb';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'time',
        'payload',
        'route',
        'user',
        'ip',
        'method'
    ];
}
