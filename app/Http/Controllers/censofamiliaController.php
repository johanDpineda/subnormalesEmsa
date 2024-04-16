<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class censofamiliaController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:censofamilia.index')->only('index');
    }
    public function index()
    {
        return  view('censofamilia.index');
    }
}
