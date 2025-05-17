<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'description'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
