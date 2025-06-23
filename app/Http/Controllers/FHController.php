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


   public function index_approve(Request $request)
{
    $searchVendor = $request->input('search_vendor');
    $searchVisitor = $request->input('search_visitor');
 $statusFilter = $request->input('status_filter');
    // Query vendor
    $vendors = Vendor::orderByRaw("CASE WHEN mode = 'URGENT' THEN 1 ELSE 2 END");

    if ($searchVendor) {
        $vendors = $vendors->where(function($query) use ($searchVendor) {
            $query->where('permit_number', 'like', '%' . $searchVendor . '%')
                ->orWhere('company_name', 'like', '%' . $searchVendor . '%')
                ->orWhere('requestor_name', 'like', '%' . $searchVendor . '%')
                ->orWhere('work_description', 'like', '%' . $searchVendor . '%')
                ->orWhere('validity_date_to', 'like', '%' . $searchVendor . '%')
                ->orWhere('status', 'like', '%' . $searchVendor . '%');
        });
    }
 if ($statusFilter && $statusFilter !== 'all') {
        $vendors = $vendors->where('status', $statusFilter);
    }
    $vendors = $vendors->paginate(2);

    // Query visitor
    $visitors = Visitor::query();

    if ($searchVisitor) {
        $visitors = $visitors->where(function($query) use ($searchVisitor) {
            $query->where('permit_number', 'like', '%' . $searchVisitor . '%')
                ->orWhere('pic_name', 'like', '%' . $searchVisitor . '%')
                ->orWhere('purpose_visit', 'like', '%' . $searchVisitor . '%')
                ->orWhere('request_date_to', 'like', '%' . $searchVisitor . '%')
                ->orWhere('status', 'like', '%' . $searchVisitor . '%');
        });
    }
  if ($statusFilter && $statusFilter !== 'all') {
        $visitors = $visitors->where('status', $statusFilter);
    }
    $visitors = $visitors->paginate(2);

    // Hitung total
    $jmlvisitors = Visitor::count();
    $jmlvendors = Vendor::count();
    $jmlpending = Vendor::where('status', 'Pending')->count() + Visitor::where('status', 'Pending')->count();
    $jmlurgent = Vendor::where('mode','Urgent')->count();

    // Logic auto reject vendor
    foreach ($vendors as $vendorVisitor) {
        if ($vendorVisitor->mode == 'Urgent') {
            continue;
        }

        if ($vendorVisitor->validity_date_from && $vendorVisitor->validity_date_to) {
            $vendorValidityDateFrom = trim($vendorVisitor->validity_date_from);
            $vendorValidityDateTo = trim($vendorVisitor->validity_date_to);

            try {
                $vendorValidityFrom = \Carbon\Carbon::createFromFormat('Y-m-d', $vendorValidityDateFrom);
                $vendorValidityTo = \Carbon\Carbon::createFromFormat('Y-m-d', $vendorValidityDateTo);
                $today = \Carbon\Carbon::today();
                $vendorDiffDays = $today->diffInDays($vendorValidityTo, false);

                if ($vendorDiffDays < 3 && $vendorVisitor->status == 'Pending') {
                    $vendorVisitor->status = 'Rejected';
                    $vendorVisitor->save();
                    Mail::to($vendorVisitor->email)->send(new \App\Mail\VendorReject($vendorVisitor, 'Rejected'));
                }
            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                dd("Error parsing date for vendor: ", $e->getMessage());
            }
        }
    }

    // Logic auto reject visitor
    foreach ($visitors as $visitor) {
        if ($visitor->request_date_from && $visitor->request_date_to) {
            $visitorRequestDateFrom = trim($visitor->request_date_from);
            $visitorRequestDateTo = trim($visitor->request_date_to);

            try {
                $visitorRequestFrom = \Carbon\Carbon::createFromFormat('Y-m-d', $visitorRequestDateFrom);
                $visitorRequestTo = \Carbon\Carbon::createFromFormat('Y-m-d', $visitorRequestDateTo);
                $today = \Carbon\Carbon::today();
                $visitorDiffDays = $today->diffInDays($visitorRequestTo, false);

                if ($visitorDiffDays < 3 && $visitor->status == 'Pending') {
                    $visitor->status = 'Rejected';
                    $visitor->save();
                    Mail::to($visitor->email)->send(new \App\Mail\VisitorReject($visitor, 'Rejected'));
                }
            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                dd("Error parsing date for visitor: ", $e->getMessage());
            }
        }
    }

    return view('approvals', compact(
        'vendors',
        'visitors',
        'jmlvisitors',
        'jmlvendors',
        'jmlpending',
        'jmlurgent',
        'searchVendor',
        'searchVisitor',
         'statusFilter'
    ));
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



// backup

//  public function index_approve(){


//         $vendors = Vendor::orderByRaw("CASE WHEN mode = 'URGENT' THEN 1 ELSE 2 END")  // Urutkan URGENT di atas
//                             ->get();
//         $visitors = Visitor::paginate(20);
//         $jmlvisitors = Visitor::count();
//         $jmlvendors = Vendor::count();
// $jmlpending = Vendor::where('status', 'Pending')->count() + Visitor::where('status', 'Pending')->count();
// $jmlurgent = Vendor::where('mode','Urgent')->count();
//     // Loop melalui setiap data dan cek validity_time
//      foreach ($vendors as $vendorVisitor) {

//     if ($vendorVisitor->mode == 'Urgent') {
//         continue;
//     }

//     // Check if validity_date_from and validity_date_to exist for vendors
//     if ($vendorVisitor->validity_date_from && $vendorVisitor->validity_date_to) {
//         // Clean the date values to remove spaces or extra characters
//         $vendorValidityDateFrom = trim($vendorVisitor->validity_date_from);
//         $vendorValidityDateTo = trim($vendorVisitor->validity_date_to);

//         // Parse dates with the format Y-m-d (without time)
//         try {
//             $vendorValidityFrom = \Carbon\Carbon::createFromFormat('Y-m-d', $vendorValidityDateFrom);
//             $vendorValidityTo = \Carbon\Carbon::createFromFormat('Y-m-d', $vendorValidityDateTo);

//             // Get today's date
//             $today = \Carbon\Carbon::today();

//             // Calculate the difference in days between today and the validity_date_to for vendor
//             $vendorDiffDays = $today->diffInDays($vendorValidityTo, false);

//             // If the difference is less than 3 days and the status is still PENDING, update to REJECTED
//             if ($vendorDiffDays < 3 && $vendorVisitor->status == 'Pending') {
//                 $vendorVisitor->status = 'Rejected';
//                 $vendorVisitor->save();
//                 Mail::to($vendorVisitor->email)->send(new \App\Mail\VendorReject($vendorVisitor, 'Rejected'));
//             }
//         } catch (\Carbon\Exceptions\InvalidFormatException $e) {
//             // Handle the error if the date format is incorrect
//             dd("Error parsing date for vendor: ", $e->getMessage());
//         }
//     }
// }

// foreach ($visitors as $visitor) {
//     // Check if request_date_from and request_date_to exist for visitors
//     if ($visitor->request_date_from && $visitor->request_date_to) {
//         // Clean the date values to remove spaces or extra characters
//         $visitorRequestDateFrom = trim($visitor->request_date_from);
//         $visitorRequestDateTo = trim($visitor->request_date_to);

//         // Parse dates with the format Y-m-d (without time)
//         try {
//             $visitorRequestFrom = \Carbon\Carbon::createFromFormat('Y-m-d', $visitorRequestDateFrom);
//             $visitorRequestTo = \Carbon\Carbon::createFromFormat('Y-m-d', $visitorRequestDateTo);

//             // Get today's date
//             $today = \Carbon\Carbon::today();

//             // Calculate the difference in days between today and the request_date_to for visitor
//             $visitorDiffDays = $today->diffInDays($visitorRequestTo, false);

//             // If the difference is less than 3 days and the status is still PENDING, update to REJECTED
//             if ($visitorDiffDays < 3 && $visitor->status == 'Pending') {
//                 $visitor->status = 'Rejected';
//                 $visitor->save();
//                 Mail::to($visitor->email)->send(new \App\Mail\VisitorReject($visitor, 'Rejected'));
//             }
//         } catch (\Carbon\Exceptions\InvalidFormatException $e) {
//             // Handle the error if the date format is incorrect
//             dd("Error parsing date for visitor: ", $e->getMessage());
//         }
//     }
// }
//     // Kirim data ke view
//     return view('approvals', compact('vendors','visitors','jmlvisitors','jmlvendors','jmlpending','jmlurgent'));
// }
