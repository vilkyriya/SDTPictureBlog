<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
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

    public function whichUser()
    {
        $user = $this->id;
        return $user;
    }

    public function isVoted($images_id)
    {
        $voted = \DB::table('images_user')->where([
            ['images_id', '=', $images_id],
            ['user_id', '=', $this->id],
        ])->exists();

        if ($voted) return "voted";
    }

    public function isVisitor()
    {
        $user = $this->roles()->where('name', '')->exists();
        if ($user) return "user";
    }
}
