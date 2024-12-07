<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enregistrement extends Model
{
    use HasFactory;


    protected $fillable = [ 'statut','utilisateur_id','film_id','nom_utilisateur'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function film()
    {
        return $this->belongsTo(Film::class);
    }








}
