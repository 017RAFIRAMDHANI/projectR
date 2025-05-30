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
        ]);



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
