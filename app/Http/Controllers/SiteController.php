<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //

    public function home() {



        $nome = 'Tanto faz';
        $a1 = 'tanto faz 2';
        return view('home', compact('nome', 'a1'));
    }
}
