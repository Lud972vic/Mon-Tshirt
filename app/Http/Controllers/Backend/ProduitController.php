<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Produit;
use App\Tag;
use App\Taille;
use App\Type;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('backend.produit.index', ['produits' => $produits]);
    }

    public function edit(Request $request)
    {
        $produits = Produit::all();
        $tags = Tag::all();
        $categories = Categorie::all();
        $produit = Produit::find($request->id);

        $tags_id = [];
        foreach ($produit->tags as $t) {
            $tags_id[] = $t->id;
        }

        $produit_recommendations = [];
        foreach ($produit->recommandations as $r) {
            $produit_recommendations[] = $r->id;
        }

        return view('backend.produit.edit', [
            'produits' => $produits,
            'categories' => $categories,
            'tags' => $tags,
            'produit' => $produit,
            'tags_id' => $tags_id,
            'produit_recommandations' => $produit_recommendations
        ]);
    }


    public function delete(Request $request)
    {
        $produit = Produit::find($request->id);
        $produit->delete();
        return redirect()->route('backend_homepage')->with('notice', 'Le produit <strong>' . $produit->nom . '</strong> a été supprimé');
    }


    public function add()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        $produits = Produit::all();
        return view('backend.produit.add', ['categories' => $categories, 'tags' => $tags, 'produits' => $produits]);
    }

    //Stocker la modification dans la db
    public function store(Request $request)
    {
//        $produit = Produit::find($request->id);
        $request->validate(
            ['nom' => 'required | max:255',
                'prix_ht' => 'required',
                'description' => 'required | max:900',
                'quantite' => 'required',
                'category_id' => 'required',
                'photo_principale' => 'required|image|max:1999'
            ]
        );


        if ($request->hasFile('photo_principale')) {
            //Recupérer le nom de l'image saisi par l'utilisateur
            $fileName = $request->file('photo_principale')->getClientOriginalName();
            //téléchargement de l image
            $request->file('photo_principale')->storeAs('public/uploads', $fileName);

            $img = Image::make($request->file('photo_principale')->getRealPath());
            $img->insert(public_path('img/favicon.png'), 'bottom-right', 10, 10);
            $img->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save('storage/uploads/' . $fileName);

        }

        $produit = new Produit();
        $produit->nom = $request->nom;
        $produit->prix_ht = $request->prix_ht;
        $produit->description = $request->description;
        $produit->photo_principale = $fileName;
        $produit->categorie_id = $request->category_id;
        $produit->quantite = $request->quantite;
        $produit->save();


        if ($request->tags) {
            foreach ($request->tags as $id) {/*Le SAVE est integré au 'attach'*/
                $produit->tags()->attach($id);
            }
        }

        if ($request->produits_recommandes) {
            foreach ($request->produits_recommandes as $id) {
                $produit->recommandations()->attach($id);
            }
        }

        return redirect()->route('backend_homepage')->with('notice', 'Le produit <strong>' . $produit->nom . '</strong> a été ajouté.');
    }


    public function update(Request $request)
    {
        $produit = Produit::find($request->id);

        $request->validate(
            ['nom' => 'required | max:255',
                'prix_ht' => 'required',
                'description' => 'required | max:900',
                'quantite' => 'required',
                'category_id' => 'required',
                'photo_principale' => 'required|image|max:1999'
            ]
        );

        if ($request->hasFile('photo_principale')) {
            //Recupérer le nom de l'image saisi par l'utilisateur
            $fileName = $request->file('photo_principale')->getClientOriginalName();
            //téléchargement de l image
            $request->file('photo_principale')->storeAs('public/uploads', $fileName);

//            $img = Image::make($request->file('photo_principale')->getRealPath());
            $img = Image::make($request->file('photo_principale')->getRealPath());
            $img->insert(public_path('img/favicon.png'), 'bottom-right', 10, 10);
//            http://image.intervention.io/api/resize
            // prevent possible upsizing
//            $img->resize(null, 400, function ($constraint) {
//                $constraint->aspectRatio();
//                $constraint->upsize();
//            });
//            $img->save('storage/uploads/' . $fileName);
            $produit->photo_principale = $fileName;

        }

        $produit->nom = $request->nom;
        $produit->prix_ht = $request->prix_ht;
        $produit->description = $request->description;
        $produit->categorie_id = $request->category_id;
        $produit->quantite = $request->quantite;
//        ***On peut faire aussi cela : remplir avec les champs de la requete HTTP pour le formualaire, mais on peut retier l'id car Update
//        $produit->fill($request->all());

        $produit->save();

//        foreach ($request->tags as $id) {/*Le SAVE est integré au 'attach'*/
//            $produit->tags()->attach($id);
//        }

//        foreach ($request->produits_recommandes as $id) {
//            $produit->recommandations()->attach($id);
//        }

        $produit->tags()->sync($request->tags);
        $produit->recommandations()->sync($request->produits_recommandes);


        return redirect()->route('backend_homepage')->with('notice', 'Le produit <strong>' . $produit->nom . '</strong> a été modifié.');
    }


    //Ajouter une taille et un stock
    public function addSize(Request $request)
    {
        $produit = Produit::find($request->id);
        $types = Type::all();
        return view('backend.produit.add_size', ['produit' => $produit, 'types' => $types]);
    }

    //Recuperer les tailles liées au type selectionné (AJAX)
    public function selectSizeAjax(Request $request)
    {
        //à evite!!! $tailles = Taille::where('type_id','=',$type_id)->get();

        $type_id = $request->type_id;
        $type = Type::find($type_id);
        $produit = Produit::find($request->produit_id);
        $tailles_produit = $produit->tailles;

        $tailles_produit_ids = [];
        foreach ($tailles_produit as $taille_produit) {
            $tailles_produit_ids[] = $taille_produit->id;
        }

        //$type->tailles;
        //dd($type->tailles);
        return view('backend.produit.select_tailles_ajax', ['tailles' => $type->tailles, 'tailles_produit_ids' => $tailles_produit_ids]);
    }

    //Stocker la taille et les produits selectionne
    public function storeSize(Request $request)
    {
        //dd($request->all());
        $produit = Produit::find($request->id);
        //dd($produit);
        //Association de la taille et la quantite liées au produit
        $produit->tailles()->attach($request->taille_id, ['qte' => $request->qte]);
        return redirect()->route('backend_produit_add_size', ['id' => $produit->id])->with('notice', 'La taille pour le porduit <strong>' . $produit->nom . '</strong> a bien été ajouté');
    }

    //Retirer l association entre une taille et un produit
    public function removeSizeAjax(Request $request)
    {
        $produit = Produit::find($request->produit_id);
        $produit->tailles()->detach($request->taille_id);
        $taille = Taille::find($request->taille_id);
        return 'La taille <strong>' . $taille->nom . '</strong> a été retirée';
    }



}
