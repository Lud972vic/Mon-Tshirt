<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use SoftDeletes;

    //Récuperer les produits d'une catégorie
    public function produits()
    {
        return $this->hasMany('App\Produit');
    }

    //Recuperer la catégorie parente d'une categorie
    public function parent()
    {
        return $this->belongsTo('App\Categorie');
    }

    //Recuperer les catégories enfant d une categorie
    public function enfants()
    {
        return $this->hasMany('App\Categorie', 'parent_id');
    }
}
