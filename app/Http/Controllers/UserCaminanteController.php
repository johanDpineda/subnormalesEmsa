<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCaminanteController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:userscaminantes.index')->only('index');
    }
    public function index()
    {
        return  view('userscaminantes.index');
    }
}
