<?php

namespace App\Models\Statuses;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'description'
    ];
}
