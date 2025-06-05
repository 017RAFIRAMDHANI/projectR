<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DHIController extends Controller
{
    public function index(){
        return view('dhi-dashboard');
    }
}
