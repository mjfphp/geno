<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $table="filieres";

    public function prof()
    {
        return $this->belongsTo('App\User','user_id');
    }


   

    public function  modules()
    {
        return $this->hasMany('App\Module');
    }

    public function niveaux()
    {
        return $this->hasMany('App\Niveau');
    }
}
