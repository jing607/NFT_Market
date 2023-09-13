<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\nft;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request, $catID = null)
    {
        // récupère toutes les catégories
        $cats = Category::all();

        // teste le paramètre d'url
        if($catID !== null){
            $catID = (int)$catID;
            $nfts = nft::where('category_id', $catID)->get();
        } else {
            $nfts = nft::all();
            $catID = 0;
        }

        return view('home', compact('nfts', 'cats', 'catID'));
    }
}
