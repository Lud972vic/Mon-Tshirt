<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use SoftDeletes;

//protected $guarded = ['id','created_id];  voir   ***On peut faire aussi cela : remplir avec les champs de la requete HTTP pour le formualaire, mais on peut retier l'id car Update

    //Afficher le prix TTC
    public function prixTTC()
    {
        return number_format($this->prix_ht * 1.2, 2);
    }

    //Recuperer la catégorie liée à un produit
    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

    //Recuperer les produits recommandés
    public function recommandations()
    {
        return $this->belongsToMany('App\Produit', 'produit_recommande', 'produit_id', 'produit_recommande_id')->withTimestamps();
    }

    //recupere les tailles disponible pour un produit
    public function tailles()
    {
        return $this->belongsToMany('App\Taille')->withTimestamps()->withPivot('qte');
//        association pour recuperer les quantites
    }

    //Recuperer les tags
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function prixTTCPanier()
    {
        return $this->prix_ht * 1.2;
    }




}
