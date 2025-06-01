<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function index($id){
         $dataID = User::where('id',$id)->first();

         return view('profile',[
            'dataID' => $dataID
            ]);
    }
}
