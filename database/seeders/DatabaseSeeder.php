<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Nft;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    private array $categories = [
        'collectible' => '1',
        'metaverse' => '2',
        'utilitaire' => '3',
        'jeux video online' => '4'
    ];

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Nft::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach($this->categories as $title=>$cat) {
            Category::factory()->create([
                "title" => $title
            ]);
        }

        $json = \file_get_contents('database/seeders/nft.json');
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

        User::factory(5)->create();

    }


}
