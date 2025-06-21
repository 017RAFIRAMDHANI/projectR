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


        $vendors = Vendor::orderByRaw("CASE WHEN mode = 'URGENT' THEN 1 ELSE 2 END")  // Urutkan URGENT di atas
                            ->get();
        $visitors = Visitor::paginate(2);
        $jmlvisitors = Visitor::count();
        $jmlvendors = Vendor::count();
$jmlpending = Vendor::where('status', 'Pending')->count() + Visitor::where('status', 'Pending')->count();
$jmlurgent = Vendor::where('mode','Urgent')->count();
    // Loop melalui setiap data dan cek validity_time
       foreach ($vendors as $vendorVisitor) {

         if ($vendorVisitor->mode == 'Urgent') {
            continue;
        }
        // Check if validity_date_from and validity_date_to exist
        if ($vendorVisitor->validity_date_from && $vendorVisitor->validity_date_to) {
            // Clean the date values to remove spaces or extra characters
            $validityDateFrom = trim($vendorVisitor->validity_date_from);
            $validityDateTo = trim($vendorVisitor->validity_date_to);

            // Parse dates with the format Y-m-d (without time)
            try {
                $validityFrom = \Carbon\Carbon::createFromFormat('Y-m-d', $validityDateFrom);
                $validityTo = \Carbon\Carbon::createFromFormat('Y-m-d', $validityDateTo);

                // Get today's date
                $today = \Carbon\Carbon::today();

                // Calculate the difference in days between today and the validity_date_to
                $diffDays = $today->diffInDays($validityTo, false); // 'false' to get a negative difference if validityTo is in the future

                // If the difference is less than 3 days and the status is still PENDING, update to REJECTED
                if ($diffDays < 3 && $vendorVisitor->status == 'Pending') {
                    $vendorVisitor->status = 'Rejected';
                    $vendorVisitor->save();
                    Mail::to($vendorVisitor->email)->send(new \App\Mail\VendorReject($vendorVisitor, 'Rejected'));
                }
            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                // Handle the error if the date format is incorrect
                dd("Error parsing date: ", $e->getMessage());
            }
        }
    }
    // Kirim data ke view
    return view('approvals', compact('vendors','visitors','jmlvisitors','jmlvendors','jmlpending','jmlurgent'));
}


    public function view($id_vendor){
       $dataVendor =  Vendor::where('id_vendor',$id_vendor)->first();
        return view('permit-details-vendor',[
            "dataVendor" => $dataVendor
        ]);
    }
    public function view_visitor($id_visitor){
        $dataVisitor =  Visitor::where('id_visitor',$id_visitor)->first();
       
        return view('permit-details-visitor',[
            "dataVisitor" => $dataVisitor
        ]);
    }
}
