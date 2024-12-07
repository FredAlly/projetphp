<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'auteur','genre','note','photo'];



    public function enregistrements()
    {
        return $this->hasMany(Enregistrement::class);
    }
    



    public function user()
    {
        return $this ->belongTo(User::class);
    }  





















}

