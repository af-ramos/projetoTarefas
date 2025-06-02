<?php

namespace App\Models\Statuses;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'description'
    ];
}
