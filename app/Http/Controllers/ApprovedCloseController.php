<?php

namespace App\Http\Controllers;

use App\Models\Approved;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApprovedCloseController extends Controller
{
           public function __construct()
    {
        $this->middleware('auth');


    }

public function index(Request $request)
{
    // Get the search query input from the request
    $searchVisitor = $request->input('search_visitor');
    $searchVendor = $request->input('search_vendor');
    $visitorStatusFilter = $request->input('visitorStatusFilter');
    $vendorStatusFilter = $request->input('vendorStatusFilter');

        $openCount = Approved::where('status', 'Open')->count();
    $closedCount = Approved::where('status', 'Closed')->count();
    $expiredCount = Approved::where('status', 'Expired')->count();
    $totalCount = Approved::count(); // Count all permits

    // Get today's date
    $currentDate = Carbon::today();

    // Start the query for fetching the data from 'Approved' table
    $dataVisitor = Approved::with('visitor'); // Start with visitor relationship
    $dataVendor = Approved::with('vendor'); // Start with vendor relationship

    // If there's a search term for Visitor, apply it to filter the results
    if ($searchVisitor) {
        $dataVisitor = $dataVisitor->whereHas('visitor', function($query) use ($searchVisitor) {
            $query->where('permit_number', 'like', '%' . $searchVisitor . '%')
                ->orWhere('pic_name', 'like', '%' . $searchVisitor . '%')
                ->orWhere('purpose_visit', 'like', '%' . $searchVisitor . '%')
                ->orWhere('request_date_to', 'like', '%' . $searchVisitor . '%')
                ->orWhere('status', 'like', '%' . $searchVisitor . '%');
        });
    }
   if ($visitorStatusFilter) {
        $dataVisitor = $dataVisitor->where('status', 'like', '%' . $visitorStatusFilter . '%');
    }


    // Fetch the filtered visitor data
    $dataVisitor = $dataVisitor->paginate(2);

    // If there's a search term for Vendor, apply it to filter the results
    if ($searchVendor) {
        $dataVendor = $dataVendor->whereHas('vendor', function($query) use ($searchVendor) {
            $query->where('permit_number', 'like', '%' . $searchVendor . '%')
                ->orWhere('company_name', 'like', '%' . $searchVendor . '%')
                ->orWhere('requestor_name', 'like', '%' . $searchVendor . '%')
                ->orWhere('work_description', 'like', '%' . $searchVendor . '%')
                ->orWhere('validity_date_to', 'like', '%' . $searchVendor . '%')
                ->orWhere('status', 'like', '%' . $searchVendor . '%');
        });
    }
   if ($vendorStatusFilter) {
        $dataVendor = $dataVendor->where('status', 'like', '%' . $vendorStatusFilter . '%');
    }
    // Fetch the filtered vendor data
    $dataVendor = $dataVendor->paginate(2);

    $Close = Approved::all();

    // Check for dates and update the status if necessary
    foreach ($Close as $approved) {
        // Check if 'request_date_to' is set for Visitor and if it is tomorrow
        if (!empty($approved->visitor->request_date_to)) {
            $requestDateTo = Carbon::parse($approved->visitor->request_date_to);
        //  dd($requestDateTo->isBefore(now()->toDateString()));
            // Check if the 'request_date_to' is tomorrow
            if ($requestDateTo->isBefore(now()->toDateString())) {
                $approved->status = 'Expired';
                $approved->save();  // Save the Approved model

                   if ($approved->visitor) {
                     $visitor = $approved->visitor;
                     $visitor->status_aktif = 'Inactive'; // Sesuaikan nilai jika berbeda
                     $visitor->save();
        }
            }
        }

        // Check if 'validity_date_to' is set for Vendor and if it is tomorrow
        if (!empty($approved->vendor->validity_date_to)) {
            $validityDateTo = Carbon::parse($approved->vendor->validity_date_to);
            // Check if the 'validity_date_to' is tomorrow
           if ($validityDateTo->isBefore(now()->toDateString())) {
                $approved->status = 'Expired';  // Update status on the Approved model
                $approved->save();  // Save the Approved model

                   if ($approved->vendor) {
                     $vendor = $approved->vendor;
                     $vendor->status_aktif = 'Inactive'; // Sesuaikan nilai jika berbeda
                     $vendor->save();
        }
            }
        }
    }

    // Pass the updated data to the view
    return view('permit-data', [
        "dataVendor" => $dataVendor,
        "dataVisitor" => $dataVisitor,
    "openCount" => $openCount,
        "closedCount" => $closedCount,
        "expiredCount" => $expiredCount,
        "totalCount" => $totalCount,
    ]);
}

public function updateStatus(Request $request)
{
    $permitId = $request->permit_id;
    $status = $request->status;

    // Find the permit in the 'approved' table by its ID
   $permit = Approved::with(['vendor', 'visitor'])->find($permitId);

    if ($permit) {
        // Update the status of the permit
        $permit->status = $status;
        $permit->save();

  if ($permit->type === 'Vendor' && $permit->vendor) {
            $permit->vendor->status_aktif = "Inactive";
            $permit->vendor->save();
        }

        if ($permit->type === 'Visitor' && $permit->visitor) {
            $permit->visitor->status_aktif = "Inactive";
            $permit->visitor->save();
        }

        // Return success response with the updated status
        return response()->json(['status' => 'success', 'updatedStatus' => $permit->status]);
    }

    // Return error response if permit not found
    return response()->json(['status' => 'error']);
}





}
