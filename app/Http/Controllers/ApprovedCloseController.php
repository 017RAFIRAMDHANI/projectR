<?php

namespace App\Http\Controllers;

use App\Models\Approved;
use Illuminate\Http\Request;

class ApprovedCloseController extends Controller
{
           public function __construct()
    {
        $this->middleware('auth');


    }
    public function index(){
        $dataVisitor = Approved::with('visitor')->get();

        return view('permit-data',[

            "dataVisitor" => $dataVisitor

        ]);
    }

}
