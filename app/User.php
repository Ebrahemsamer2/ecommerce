<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    public function scopeUsers($query) {
        return $query->where('admin', 0);
    }

    public function scopeAdmins($query) {
        return $query->where('admin', 1);
    }

    public function scopeSupers($query) {
        return $query->where('is_super', 1);
    }

    protected $fillable = [
        'name', 'email', 'password','admin','is_super',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
