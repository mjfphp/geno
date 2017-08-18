<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    //
    protected $table="seances";

    public function prof()
    {
        return $this->hasMany('App\User','id','id_prof');
    }
    public function matieres()
    {
        return $this->hasOne('App\Matiere','id','id');
    }
}
