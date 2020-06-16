<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'name', 'login', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    public function isAdministrator()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function isUser()
    {
        $user = $this->roles()->where('name', 'user')->exists();
        if ($user) return "user";
    }
}
