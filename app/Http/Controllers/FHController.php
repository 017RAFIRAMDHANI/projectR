<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Vendor_Visitor;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FHController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();

    }
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

    // $vendorVisitors = Vendor::with(['vendor', 'visitor'])
    //     ->orderByRaw("CASE WHEN mode = 'URGENT' THEN 1 ELSE 2 END")  // Urutkan URGENT di atas
    //     ->get();

        $vendorVisitors = Vendor::orderByRaw("CASE WHEN mode = 'URGENT' THEN 1 ELSE 2 END")  // Urutkan URGENT di atas
                            ->get();

    // Loop melalui setiap data dan cek validity_time
     foreach ($vendorVisitors as $vendorVisitor) {
        // Cek apakah validity_date_from dan validity_date_to ada
        if ($vendorVisitor->validity_date_from && $vendorVisitor->validity_date_to) {
            // Bersihkan nilai tanggal dari spasi atau karakter ekstra
            $validityDateFrom = trim($vendorVisitor->validity_date_from);
            $validityDateTo = trim($vendorVisitor->validity_date_to);

            // Parsing tanggal dengan format Y-m-d (tanpa waktu)
            try {
                $validityFrom = \Carbon\Carbon::createFromFormat('Y-m-d', $validityDateFrom);
                $validityTo = \Carbon\Carbon::createFromFormat('Y-m-d', $validityDateTo);


                $diffDays = $validityFrom->diffInDays($validityTo);



                // Jika selisihnya kurang dari 3 hari, set status jadi REJECT jika statusnya masih PENDING
                if ($diffDays < 3 && $vendorVisitor->status == 'Pending') {
                    $vendorVisitor->status = 'Reject';
                    $vendorVisitor->save();
                   Mail::to($vendorVisitor->email)->send(new \App\Mail\VendorReject($vendorVisitor, 'Rejected'));
                }
            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                // Tangani error jika formatnya tidak sesuai
                dd("Error parsing date: ", $e->getMessage());
            }
        }
    }

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
