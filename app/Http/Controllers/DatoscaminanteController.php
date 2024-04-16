<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatoscaminanteController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:Caminantes.index')->only('index');
    }
    public function index()
    {
        return  view('Caminantes.index');
    }
}
