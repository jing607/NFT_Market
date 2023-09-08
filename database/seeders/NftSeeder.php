<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nft;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class NftSeeder extends Seeder
{
    private array $categories = [
        'collectible' => '1',
        'metaverse' => '2',
        'utilitaire' => '3',
        'jeux vidéo online' => '4'
    ];

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Nft::truncate();
        // $json = File::get("database/data/nft.json");
        // $nfts = json_decode($json);
        // $nfts = Storage::json('/Users/hj/Desktop/cours/5_Projet2/Projet2_NFT-Market/NFT_Market/database/data/nft.json');
        $json = \file_get_contents('/Users/hj/Desktop/cours/5_Projet2/Projet2_NFT-Market/NFT_Market/database/data/nft.json');
        $nfts = json_decode($json);
        foreach ($nfts as $key => $value) {
            Nft::factory()->create([
                "title" => $value->titre,
                "artist" => $value->artiste,
                "description" => $value->description,
                "contrat" => $value->adresse,
                "standard_token" => $value->standard,
                "price" => $value->prix,
                "image" => $value->fichier,
                "category_id" => $this->categories[$value->catégorie]
                ]);
        }
    }
}
