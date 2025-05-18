<?php

namespace App\Models;

use App\Models\Statuses\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'owner_id',
        'assigned_id',
        'project_id'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function status() {
        return $this->belongsTo(TaskStatus::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function assigned() {
        return $this->belongsTo(User::class);
    }
}
