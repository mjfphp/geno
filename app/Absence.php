<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected $table="absences";

    public function seance(){
        return $this->hasMany('App\Seance','id','id_seance');
    }
    
    public function eleve(){
        return $this->hasOne('App\Eleve','id','id');
    }
}
