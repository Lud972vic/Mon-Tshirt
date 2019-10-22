<?php

use Illuminate\Database\Seeder;
use App\Produit;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $produit = new Produit();
//        $produit->nom = "T-Shirt Gonnies";
//        $produit->prix_ht = 25;
//        $produit->description = "T-Shirt du film les Gonnies";
//        $produit->photo_principale = "goonies.jpg";
//        $produit->categorie_id = 1;
//        $produit->save();
//
//        $produit = new Produit();
//        $produit->nom = "T-shirt Star Trek";
//        $produit->prix_ht = 23;
//        $produit->description = "T-shirt Star Trek";
//        $produit->photo_principale = "star_trek.jpg";
//        $produit->categorie_id = 1;
//        $produit->save();
//
//        $produit = new Produit();
//        $produit->nom = "T-shirt Hulk";
//        $produit->prix_ht = 19;
//        $produit->description = "T-shirt Hulk";
//        $produit->photo_principale = "hulk.jpg";
//        $produit->categorie_id = 2;
//        $produit->save();
//
//        $produit = new Produit();
//        $produit->nom = "T-Shirt Wonder Woman";
//        $produit->prix_ht = 19;
//        $produit->description = "T-Shirt Wonder Woman";
//        $produit->photo_principale = "wonder_woman.jpg";
//        $produit->categorie_id = 2;
//        $produit->save();

        $produit = new Produit();
        $produit->nom = "T-Shirt les simpsons";
        $produit->prix_ht = 22;
        $produit->description = "T-Shirt les simpsons";
        $produit->photo_principale = "simpsons.jpg";
        $produit->categorie_id = 2;
        $produit->save();
    }
}
