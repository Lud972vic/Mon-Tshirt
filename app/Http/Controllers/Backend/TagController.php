<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //lister les tags
    public function index()
    {
        $tag = Tag::all();
        $categories = Categorie::where('parent_id', '=', null)->paginate(3);
        return view('backend.tag.index', ['tags' => $tag, 'categories' => $categories]);
    }

    //ajouter un tag
    public function add()
    {
        return view('backend.tag.add');
    }

    //Stocker un tag dans la db
    public function store(Request $request)
    {
        //Validation du form
        $request->validate(
            ['nom' => 'required|max:50']
        );
        //Création de l'objet Tab
        $tag = new Tag();
        $tag->nom = $request->nom;
        //Sauvegarde dans la db
        $tag->save();
        //Redirection vers la page qui liste les tags
        return redirect()->route('backend_tags_index')->with('notice', 'Le tag <strong> ' . $tag->nom . ' </strong> a bien été rajouté.');
    }

    public function edit(Request $request)
    {
        //Recuperer dans la db le tag à modifier
        //On récupère le parametre du tag via l'url définie dans la route
        $tag = Tag::find($request->id);
        //dd($tag);
        return view('backend.tag.edit', ['tag' => $tag]);
    }

    //Execution de la modification
    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:50'
        ]);

        $tag = Tag::find($request->id);
        $tag->nom = $request->nom;
        $tag->save();
        return redirect()->route('backend_tags_index')->with('notice', 'Le tag <strong> ' . $tag->nom . ' </strong> a bien été modifié.');
    }

    //On supprime le tag
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        return redirect()->route('backend_tags_index')->with('notice', 'Le tag <strong> ' . $tag->nom . ' </strong> a bien été supprimé.');
    }
}
