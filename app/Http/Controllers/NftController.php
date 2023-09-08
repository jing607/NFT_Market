<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Illuminate\Http\Request;

class NftController extends Controller
{

    public function index()
    {
        return view('nft.list', [
            'nfts' => Nft::all()
        ]);
    }
}
