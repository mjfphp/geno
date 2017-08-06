<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table="departements";

    public function profs()
    {
        return $this->hasMany('App\User');
    }

    

    public function chefD()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function modules()
    {
        return $this->hasMany('App\Module');
    }
}
