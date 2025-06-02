<?php

namespace App\Models;

use App\Models\Statuses\TaskStatus;
use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([TaskObserver::class])]
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
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function status() {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function assigned() {
        return $this->belongsTo(User::class, 'assigned_id');
    }
}
