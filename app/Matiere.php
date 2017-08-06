<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    public $table="matieres";

    public function prof()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function module()
    {
        return $this->belongsTo('App\Module','module_id');
    }
}
