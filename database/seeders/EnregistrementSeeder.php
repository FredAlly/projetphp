<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; 

class EnregistrementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtenez les IDs des utilisateurs et des films pour la création d'enregistrements
        $userIds = DB::table('users')->pluck('id')->toArray();
        $filmIds = DB::table('films')->pluck('id')->toArray();

        
        for ($i = 0; $i < 5; $i++) { 
            // Choisir un ID utilisateur aléatoire
            $idUtilisateur = $faker->randomElement($userIds);

            // Obtenir le nom de l'utilisateur correspondant à l'ID
            $nomUtilisateur = DB::table('users')->where('id', $idUtilisateur)->value('name');

            DB::table('enregistrements')->insert([
                'id_utilisateur' => $idUtilisateur, // ID utilisateur aléatoire
                'id_film' => $faker->randomElement($filmIds), // ID film aléatoire
                'statut' => $faker->randomElement(['à voir', 'vu', 'en cours']), // Statut aléatoire
                'date' => now(), // Date actuelle
                'efface' => $faker->boolean(20), // 20% de chance que ce soit vrai
                'nom_utilisateur' => $nomUtilisateur, // Nom d'utilisateur correspondant
                'created_at' => now(), // Date de création
                'updated_at' => now(), // Date de mise à jour
            ]);
        }
    }
}
