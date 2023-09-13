<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Nft;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function adminUserList()
    {
        $users = User::all();

        foreach($users as $user){
            $count = Nft::where('user_id', $user->id)->count();
            $user->nftCount = $count;
        }

        return view('admin/userList', compact('users'));
    }

    public function showNftList()
    {
        $nfts = Nft::all();
        $users = User::all();
        $cats = Category::all();

        foreach($nfts as $nft){
            foreach($users as $user){
                if((int)$user->id === (int)$nft->user_id) {
                    $nft->ownerName = $user->name;
                    $nft->ownerEmail = $user->email;
                }
            }
            if(!$nft->ownerName) {
                $nft->ownerName = "--";
                $nft->ownerEmail = "--";
            }

            foreach($cats as $cat) {
                if((int)$cat->id === (int)$nft->category_id) {
                    $nft->catName = $cat->title;
                }
            }
        }

        // dd($nfts);

        return view('admin/nftList', compact('nfts'));
    }


    public function create()
    {


        return view('admin/nftAdd');
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'description' => 'required|string',
            'contrat' => 'required|string|max:255',
            'standard_token' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,mp4,mov|max:4096',
        ]);

        // Traitement du téléchargement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = "images/" . $imageName;
        } else {
            $imageName = null;
            $imagePath = null;
        }

        // Créer une nouvelle instance de l'entité "Oeuvre" avec les données soumises
        $oeuvre = new Nft([
            'title' => $request->input('title'),
            'artist' => $request->input('artist'),
            'description' => $request->input('description'),
            'contrat' => $request->input('contrat'),
            'standard_token' => $request->input('standard_token'),
            'price' => $request->input('price'),
            'image' => $imagePath,
        ]);

        // Sauvegarder l'entité "Oeuvre" dans la base de données
        $oeuvre->save();

        // Rediriger l'utilisateur vers une page de confirmation ou une autre page appropriée
        return redirect()->route('admin.nft.list')->with('success', 'Oeuvre créée avec succès.');
    }



    public function destroy($id = null): RedirectResponse
    {
        if(!$id){
            return redirect('admin.nft.list');
        }

        $nft = Nft::find($id);

        // Vérifier si l'œuvre existe
        if (!$nft) {
            return redirect()->route('admin.nft.list')->with('error', 'Nft non trouvée.');
        }

        // Supprimer l'image associée (si elle existe)
        if ($nft->image) {
            unlink(base_path('public/images/' . basename($nft->image)));
        }

        // Supprimer l'œuvre de la base de données
        $nft->delete();

        return redirect()->route('admin.nft.list')->with('success', 'nft supprimée avec succès.');
    }
}
