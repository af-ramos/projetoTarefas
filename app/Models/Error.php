<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Error extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'errors';

    public $timestamps = false;

    protected $fillable = [
        'date',
        'time',
        'payload',
        'route',
        'user',
        'ip',
        'method',
        'error'
    ];
}
