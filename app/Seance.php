<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    //
    protected $table="seances";

    public function prof()
    {
        return $this->belongsTo('App\User');
    }
    public function matiere()
    {
        return $this->hasOne('App\Matiere','id','id');
    }
}
