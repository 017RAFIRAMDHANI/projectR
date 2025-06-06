<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FHController extends Controller
{
    //
    public function index(){
        return view('fm-dashboard');
    }
    public function specialpopup(){
        return view('special-popup');
    }
}
