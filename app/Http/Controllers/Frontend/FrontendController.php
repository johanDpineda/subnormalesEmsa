<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\League;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function index(){

   
      return view('frontend.index');
  }
}
