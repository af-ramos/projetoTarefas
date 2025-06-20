<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function notifications() {
        return $this->belongsToMany(Notification::class, 'notification_user', 'user_id', 'notification_id');
    }
    
    public function getJWTIdentifier() {
        return $this->getKey();    
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
