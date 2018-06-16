<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, Notifiable;

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

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function roles(){
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function words(){
        return $this->hasMany('App\Word');
    }
    public function files(){
        return $this->hasMany('App\File');
    }



    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $role)
            {
                if ($this->hasRole($role)){
                    return true;
                }
            }
        }elseif ($this->hasRole($roles)){
            return true;
        }else return false;
    }

    public function hasRole($role)
    {
        //is the user has the role specified in $role then return true
        if ($this->roles()->where('name', $role)->first()){
            return true;
        }else return false;

    }


}
