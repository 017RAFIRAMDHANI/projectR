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

    // $vendorVisitors = Vendor_Visitor::with(['vendor', 'visitor'])->get();

    //     // Kirim data ke view
    //     return view('approvals', compact('vendorVisitors'));

    $vendorVisitors = Vendor_Visitor::with(['vendor', 'visitor'])
        ->orderByRaw("CASE WHEN mode = 'URGENT' THEN 1 ELSE 2 END")  // Urutkan URGENT di atas
        ->get();

    // Kirim data ke view
    return view('approvals', compact('vendorVisitors'));
    }

    public function view($id_vendor){
       $dataVendor =  Vendor::where('id_vendor',$id_vendor)->first();
        return view('permit-details-vendor',[
            "dataVendor" => $dataVendor
        ]);
    }
}
