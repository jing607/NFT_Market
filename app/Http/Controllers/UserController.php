<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showCollection() {
        $nfts = Nft::where('user_id', auth()->user()->id)->get();
        // dd($nfts);

        return view('userCollection', compact('nfts'));
    }


    public function addToCollection($id = null) {
        if(!$id) {
            return redirect()->route('user.collection');
        }

        try {
            Nft::where('id', $id)->update([
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $e) {
            session()->flash('error', "Une erreur s'est produite, votre achat n'a pas pu aboutir...");
            return redirect()->route('user.collection');
        }

        session()->flash('success', 'Nft acheté avec succès!!');

        return redirect()->route('user.collection');
    }


    public function removeFromCollection($id = null) {
        if(!$id) {
            return redirect()->route('user.collection');
        }

        try {
            Nft::where('id', $id)->update([
                'user_id' => null,
            ]);
        } catch (Exception $e) {
            session()->flash('error', "Une erreur s'est produite, votre vente n'a pas pu aboutir...");
            return redirect()->route('user.collection');
        }

        session()->flash('success', 'Nft Vendu avec succès !');

        return redirect()->route('user.collection');
    }

}
