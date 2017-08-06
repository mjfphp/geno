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
        'name', 'email', 'password','confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $table="users";

    public function departement()
    {
        return $this->belongsTo('App\Departement');
    }

    public function chef_departement()
    {
        return $this->hasOne('App\Departement');
    }

    public function matieres()
    {
        return $this->hasMany('App\Matiere');
    }

    public function modules()
    {
        return $this->hasMany('App\Module');
    }
}
