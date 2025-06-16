<?php

namespace App\Http\Controllers;
use App\Models\Local;

use Illuminate\Http\Request;

class locauxController extends Controller
{



    public function locaux()
    {
        $locaux = Local::all();
        return view('etudiant.locaux', compact('locaux'));
    }



}
