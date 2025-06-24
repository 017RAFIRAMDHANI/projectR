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
 public function index()
{
    // Get today's date
    $currentDate = Carbon::today();

    // Fetch the data for Visitor and Vendor directly from Approved
    $dataVendor = Approved::with('vendor')->get();
    $dataVisitor = Approved::with('visitor')->get();
    $Close = Approved::all();

    // Check for dates and update the status if necessary
    foreach ($Close as $approved) {
        // Check if 'request_date_to' is set for Visitor and if it is tomorrow
        if (!empty($approved->visitor->request_date_to)) {
            $requestDateTo = Carbon::parse($approved->visitor->request_date_to);
        //  dd($requestDateTo->isBefore(now()->toDateString()));
            // Check if the 'request_date_to' is tomorrow
            if ($requestDateTo->isBefore(now()->toDateString())) {
                $approved->status = 'Expired';  // Update status on the Approved model
                $approved->save();  // Save the Approved model
            }
        }

        // Check if 'validity_date_to' is set for Vendor and if it is tomorrow
        if (!empty($approved->vendor->validity_date_to)) {
            $validityDateTo = Carbon::parse($approved->vendor->validity_date_to);
            // Check if the 'validity_date_to' is tomorrow
           if ($validityDateTo->isBefore(now()->toDateString())) {
                $approved->status = 'Expired';  // Update status on the Approved model
                $approved->save();  // Save the Approved model
            }
        }
    }

    // Pass the updated data to the view
    return view('permit-data', [
        "dataVendor" => $dataVendor,
        "dataVisitor" => $dataVisitor,
    ]);
}

public function updateStatus(Request $request)
{
    $permitId = $request->permit_id;
    $status = $request->status;

    // Find the permit in the 'approved' table by its ID
    $permit = Approved::find($permitId);

    if ($permit) {
        // Update the status of the permit
        $permit->status = $status;
        $permit->save();

        // Return success response with the updated status
        return response()->json(['status' => 'success', 'updatedStatus' => $permit->status]);
    }

    // Return error response if permit not found
    return response()->json(['status' => 'error']);
}





}
