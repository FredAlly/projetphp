<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Film;

use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::paginate(12);
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('films.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nom' => 'required',
            'auteur' => 'required',
            'note' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis')->withErrors($validator);
        }
    
        try {
            // Traitement de l'image après validation
            if ($request->file('photo')->isValid()) {
                $image = $request->file('photo');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->move(public_path('images/upload'), $fileName);
    
                // Création du film avec le chemin de l'image
                Film::create(array_merge($request->all(), ['photo' => $fileName]));
    
                return redirect('/')->with('success', 'Film ajouté avec succès');
            }
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Échec du téléchargement de l\'image');
        }
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::findOrFail($id);

        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FIlm $film)
    {
       /*  $request->validate([
            'nom'=>'required',
            'content'=> 'required', 

        ]); */
          /*     $film = film::findOrFail($id);
        $film->nom = $request->get('nom');
        $film->content = $request->get('content');

        $film->update(); */

        $validator = Validator::make($request->all(),[
            'nom'=>'required',
            'auteur'=> 'required',
            'note'=> 'required',
            'photo'=> 'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('warning','Tous les champs sont requis');   
        }
    else{
        $film->update($request->all());
        return redirect('/')->with('success', 'film Modifié avec succès');
    }
}


public function autocomplete(Request $request)
{
    $search = $request->search;
    $films = Film::orderby('nom','asc')
                ->select('id','nom')
                ->where('nom', 'LIKE', '%'.$search. '%')
                ->get();
                $response = array();
                foreach($films as $film){
                    $response[] = array(
                        'value' => $film->id,
                        'label' => $film->nom
                    );
                }
                /* $users = User::orderby('name','asc')
                ->select('id','name')
                ->where('name', 'LIKE', '%'.$search. '%')
                ->get();
                $response = array();
                foreach($users as $user){
                    $response[] = array(
                        'value' => $user->id,
                        'label' => $user->name
                    );
                }
*/

    return response()->json($response);
}







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();
        return redirect('/')->with('success', 'films Supprimé avec succès');
    }
    
    
    public function showUtilisateurs($id)
    {
        // Récupérer le film avec l'ID fourni
        $film = Film::findOrFail($id);
    
        // Passer les enregistrements (utilisateurs) à la vue
        return view('films.listeUtilisateurs', compact('film'));
    }
    
    











}
