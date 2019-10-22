<?php

use Illuminate\Database\Seeder;
use App\Taille;

class TaillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $tailles = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $tailles = ['54', '55', '56', '57', '58', '59', '60', '61'];
        foreach ($tailles as $t) {
            $taille = new Taille();
            $taille->nom = $t;
            $taille->type_id = 4;
            $taille->save();
        }
    }
}
