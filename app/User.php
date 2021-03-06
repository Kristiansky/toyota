<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'additional_emails', 'parent_id',
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
    
    public function permissions(){
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    
    public function hasRole($role_slug){
        if (is_array($role_slug)){
            foreach ($role_slug as $role_slug_check) {
                foreach ($this->roles as $role) {
                    if ($role_slug_check == $role->slug){
                        return true;
                    }
                }
            }
        }else{
            foreach ($this->roles as $role) {
                if ($role_slug == $role->slug){
                    return true;
                }
            }
        }
    }
    
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
