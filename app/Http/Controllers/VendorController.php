<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
      public function create()
{
        return view('new-permit');
}

public function store(Request $request)
{
    try {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'requestor_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'location_of_work' => 'required|string|max:255',
            'building_level_room' => 'required|string|max:255',
            'work_description' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'generate_dust' => 'required',
            'vehicle_types' => 'required',
            'number_plate' => 'required',
            'protection_system' => 'required|string',
            'file_mos' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'worker1_name' => 'required|string|max:255',
            'worker1_id_nopermit' => 'required|string|max:255',
            'worker2_name' => 'required|string|max:255',
            'worker2_id_nopermit' => 'required|string|max:255',
            'worker3_name' => 'required|string|max:255',
            'worker3_id_nopermit' => 'required|string|max:255',
            'worker4_name' => 'required|string|max:255',
            'worker4_id_nopermit' => 'required|string|max:255',
            'worker5_name' => 'required|string|max:255',
            'worker5_id_nopermit' => 'required|string|max:255',
            'mode' => 'required|string',
        ]);

   if ($request->hasFile('file_mos')) {
            // Store file in the 'mos_files' directory within 'public' disk
            $fileMos = $request->file('file_mos')->store('mos_files', 'public');
               Log::info('File Path:', ['file_mos' => $fileMos]);
        }

          // Generate permit number in format "VD-YYMM-XXX"
        $date = new \DateTime();
        $year = $date->format('y'); // Last two digits of the year
        $month = $date->format('m'); // Month
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT); // Random 3 digit number
        $permitNumber = "VD-{$year}{$month}-{$random}";



        // Create Vendor record
        $vendor = Vendor::create([
            'company_name' => $validatedData['company_name'],
            'requestor_name' => $validatedData['requestor_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'location_of_work' => $validatedData['location_of_work'],
            'building_level_room' => $validatedData['building_level_room'],
            'work_description' => $validatedData['work_description'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'generate_dust' => $validatedData['generate_dust'],
            'protection_system' => $validatedData['protection_system'],
            'number_plate' => $validatedData['number_plate'],
            'vehicle_types' => $validatedData['vehicle_types'],
            'file_mos' => $fileMos,
            'worker1_name' => $validatedData['worker1_name'],
            'worker1_id_nopermit' => $validatedData['worker1_id_nopermit'],
            'worker2_name' => $validatedData['worker2_name'],
            'worker2_id_nopermit' => $validatedData['worker2_id_nopermit'],
            'worker3_name' => $validatedData['worker3_name'],
            'worker3_id_nopermit' => $validatedData['worker3_id_nopermit'],
            'worker4_name' => $validatedData['worker4_name'],
            'worker4_id_nopermit' => $validatedData['worker4_id_nopermit'],
            'worker5_name' => $validatedData['worker5_name'],
            'worker5_id_nopermit' => $validatedData['worker5_id_nopermit'],
            'mode' => $validatedData['mode'],
            'permit_number' =>  $permitNumber,
        ]);

        // Return a success response with data
        return redirect()->route('vendor_create')->with('success', 'Vendor permit request submitted successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        $errors = $e->validator->errors();
        Log::error('Validation Errors:', $errors->all());
        return back()->withErrors($errors)->withInput();

    } catch (\Exception $e) {
        // Log the exception error
        Log::error('Error submitting vendor permit request', ['error' => $e->getMessage()]);
        return back()->with('error', 'There was an error submitting the form. Please try again.');
    }
}


}
