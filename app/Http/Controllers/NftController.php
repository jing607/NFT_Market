<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NftController extends Controller
{

    public function showNftDetails(Request $request, $id = null){
        if(null === $id) {
            return Redirect::route('home');
        }
        $nft = Nft::where('id', (int)$id)->get();

        if(empty($nft)) {
            return Redirect::route('home');
        } else {
            $nft = $nft[0];
            $owner = User::where('id', $nft->user_id)->get();
            if(count($owner)){
                $owner = $owner[0];
            } else {
                $owner = null;
            }
        }

        $canBuy = true;

        // si l utilisateur est enregistré et a assez dETH pour acheter le nft
        // canBuy reste à true sinon il passe à false
        if(auth()->check()){
            $canBuy = (float)auth()->user()->wallet >= (float)$nft->price;
        } else {
            // si l'utilisateur n'est pas enregistré
            $canBuy = false;
        }

        // si l'utilisateur est loggué et a suffisamment pour acheter
        // mais que le nft a déjà un propriétaire alors canbuy passe a false
        if($canBuy && $nft->user_id) {
            $canBuy = false;
        }


        return view('nft/list', compact('nft', 'canBuy','owner'));
    }



}
