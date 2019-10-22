<?php

use Illuminate\Database\Seeder;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categorie = new \App\Categorie();
        $categorie->nom = "Films";
        $categorie->save();

        $categorie = new \App\Categorie();
        $categorie->nom = "Séries TV";
        $categorie->save();

        $categorie = new \App\Categorie();
        $categorie->nom = "Musique";
        $categorie->save();

        $categorie = new \App\Categorie();
        $categorie->nom = "Jeux-Vidéos";
        $categorie->save();

        $categorie = new \App\Categorie();
        $categorie->nom = "Sport";
        $categorie->save();
    }
}
