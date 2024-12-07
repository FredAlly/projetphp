<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; 

use App\Models\Enregistrement;

use Illuminate\Support\Facades\Validator;

class EnregistrementController extends Controller
{




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'statut' => 'required',
            'film_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        } else {
            // Vérifie que l'utilisateur est connecté
            if (!auth()->check()) {
                return redirect()->back()->with('warning', 'Vous devez être connecté pour ajouter un enregistrement.');
            }
    
            Enregistrement::create([
                'statut' => $request->statut,
                'film_id' => $request->film_id,
                'utilisateur_id' => auth()->id(), // Utilise l'ID de l'utilisateur connecté
                'nom_utilisateur' => auth()->user()->name, // Prend le nom de l'utilisateur connecté
                'date' => now(), // Enregistre la date actuelle
            ]);
    
            return redirect()->back()->with('success', 'Votre Enregistrement a été ajouté');
        }
    }
    


 



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enregistrement = Enregistrement::find($id);
    
        // Vérifie si l'enregistrement existe
        if (!$enregistrement) {
            return redirect()->back()->with('warning', 'Enregistrement non trouvé');
        }
    
        // Vérifie si l'utilisateur est un admin ou le propriétaire de l'enregistrement
        if (!auth()->user()->isAdmin() && auth()->id() !== $enregistrement->utilisateur_id) {
            return redirect()->back()->with('warning', 'Vous n\'avez pas la permission de supprimer cet enregistrement');
        }
    
        // Supprime l'enregistrement
        $enregistrement->delete();
    
        return redirect()->back()->with('success', 'Enregistrement supprimé avec succès');
    }
    
}
