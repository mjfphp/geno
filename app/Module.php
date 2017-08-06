<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected  $table="modules";

    public function matieres()
    {
        return $this->hasMany('App\Matiere');
    }

    public function coordinateur()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function departement()
    {
        return $this->belongsTo('App\Departement','departement_id');
    }

    public function niveau()
    {
        return $this->belongsTo('App\Niveau','niveau_id');
    }
}
