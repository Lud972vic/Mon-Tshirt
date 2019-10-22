<?php

namespace App\Http\Controllers\Backend;

use App\Commande;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //afficher la liste des commandes
    public function index()
    {
        $commandes = Commande::orderBy('id', 'desc')->paginate(3);
        return view('backend.commande.index', ['commandes' => $commandes]);
    }

    //Afficher le detail d une commande
    public function show(Request $request)
    {
        $commande = Commande::find($request->id);
        return view('backend.commande.show', ['commande' => $commande]);
    }

}
