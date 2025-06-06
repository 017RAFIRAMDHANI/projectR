<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Vendor_Visitor;
use App\Models\Visitor;
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
    public function index_approve(){
    // $vendors = Vendor::all();
    // $visitors = Visitor::all();

    // // Kirim data vendor dan visitor ke view
    // return view('approvals', compact('vendors', 'visitors'));
    $vendorVisitors = Vendor_Visitor::with(['vendor', 'visitor'])->get();

        // Kirim data ke view
        return view('approvals', compact('vendorVisitors'));

    }
}
