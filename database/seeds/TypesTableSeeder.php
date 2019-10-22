<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $type = new Type();
        $type->nom = "Vêtement";
        $type->save();

        $type = new Type();
        $type->nom = "Chassure";
        $type->save();

        $type = new Type();
        $type->nom = "Pantalon";
        $type->save();

        $type = new Type();
        $type->nom = "Châpeau";
        $type->save();
    }
}
