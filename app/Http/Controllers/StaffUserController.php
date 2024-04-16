<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffUserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:staffuser.index')->only('index');
    }
    public function index()
    {

        return view('staffuser.index');

    }
}
