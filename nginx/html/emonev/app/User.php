<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip', 'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeCari($query, $cari) {
        return $query->where('name', 'like', '%'.$cari.'%')
                ->orWhere('nip', 'like', '%'.$cari.'%')
                ->orWhere('email', 'like', '%'.$cari.'%')
                ->orWhere('username', 'like', '%'.$cari.'%');
    }
}
