<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlterrenosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:controlTerrenos.index')->only('index');
    }
    public function index()
    {
        return  view('controlTerrenos.index');
    }
}
