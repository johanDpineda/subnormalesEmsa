<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearSubnormalController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:CrearSubNormal.index')->only('index');
    }
    public function index()
    {
        return  view('CrearSubNormal.index');
    }
}
