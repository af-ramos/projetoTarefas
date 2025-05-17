<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'logs';

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
