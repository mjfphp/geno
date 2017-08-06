<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $table="niveaus";

    public function filiere()
    {
        return $this->belongsTo('App\Filiere','filiere_id');
    }

    public function modules()
    {
        return  $this->hasMany('App\Module');
    }

    public function eleves()
    {
        return   $this->hasMany('App\Eleve');
    }
}