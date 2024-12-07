<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; 

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Vous pouvez définir combien d'enregistrements vous souhaitez créer
        for ($i = 0; $i < 3; $i++) { // Exemple pour 10 films
            DB::table('films')->insert([
                'nom' => $faker->sentence(3), // Un nom de film avec 3 mots
                'auteur' => $faker->name, // Nom d'un auteur
                'genre' => $faker->word, // Un genre de film
                'note' => $faker->numberBetween(1, 10), // Une note entre 1 et 10
                'created_at' => now(), // Date de création
                'updated_at' => now(), // Date de mise à jour
            ]);
        }
    }
}
