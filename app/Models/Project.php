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
        return $this->hasMany(Task::class);
    }

    public function status() {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }
}
