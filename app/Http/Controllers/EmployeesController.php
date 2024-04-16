<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //
    public function __construct(){
        $this->middleware('can:employees.index')->only('index');
    }
    public function index()
    {
        return view('employees.index');
    }
}
