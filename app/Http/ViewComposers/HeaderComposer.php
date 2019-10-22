<?php

namespace App\Http\ViewComposers;

use App\Categorie;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
//variables sur toutes les pages
        $matches = ['is_online' => 1, 'parent_id' => null];
        $view->with('categories', Categorie::where($matches)->get())
            ->with('total_panier', \Cart::getTotalQuantity());
    }
}
