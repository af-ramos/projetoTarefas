<?php

namespace App\Models;

use App\Models\Statuses\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'owner_id'
    ];

    public function tasks() {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function status() {
        return $this->belongsTo(ProjectStatus::class, 'status_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
