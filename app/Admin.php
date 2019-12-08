<?php

namespace App;

use App\User;
use App\Scopes\AdminScope;

class Admin extends User
{
    public static function boot() {
        parent::boot();
        static::addGlobalScope(new AdminScope);
    }
}
