<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::latest()->paginate(10);
        return response()->json( 
            
             $films,200
    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $film = $request->all();
        
        $request->validate([
        'nom'     => 'required',
        'auteur'   => 'required',
        'genre'   => 'required',
        'note'   => 'required',
        'photo'     => 'required|image'
    ]);

     
  
    if ($film = $request ->file('photo')){
        $image = $request->photo;
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('images/upload', $fileName, 'public');
      // $film=$request-> $fileName ;
      // $film = $fileName ;
    }

 $film =  Film::create([
    'nom' => $request->input('nom'),
    'auteur' => $request->input('auteur'),
    'genre' => $request->input('genre'),
    'note' => $request->input('note'),
    
    'photo' => $fileName,
]);
  
      // On retourne les informations du nouvel film en JSON
     return response()->json([$film,"message" => "Film ajouté"], 201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Film::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);
        if (!$film) {
            return response() ->json(['message' => 'Id not found'], 404);
        }
        $validator = Validator::make($request->all(),[
            'nom'=>'required',
            'auteur'=> 'required',
            'photo'=> 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        if ($validator->fails()) {
            return response() ->json(['success' => false, 'message' => $validator->errors()], 400);
        }
 
        if ($request->hasfile('photo')) {
            $image = $request->photo;
            $fileName = time() . '.' . $image->getClientOriginalName();
            $path = $request->photo->storeAs('images/upload', $fileName, 'public');
            $film['photo'] = $path;
    
        }
        $film->update($request->except('photo'));

        return response()->json([$film,"message" => "Film modifé avec succée" ] );
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
        if ($film->photo) {
            Storage::disk('public')->delete($film->photo);
        }
          $film->delete();
        return response()->json(null, 204);
    }
}
