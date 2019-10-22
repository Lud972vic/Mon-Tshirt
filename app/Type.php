<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //protected $table = "types_tailles"; si soucis lors de la création des tables ->php artisan make:model Type -m : crée le model et le fichier de migration en meme tempts

    //récuperer les tailles
    public function tailles()
    {
        return $this->hasMany('App\Taille');//type à plusieurs tailles
    }
}
