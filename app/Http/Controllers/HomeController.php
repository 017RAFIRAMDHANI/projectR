<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Sheets;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function index()
{
    $client = new Google_Client();
    $client->setAuthConfig(config('google.credentials_path'));
    $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

    $service = new Google_Service_Sheets($client);

    $spreadsheetId = '1XsY2nAyvprk8vg72SjYwW1nn1pfLI4ekAKNZUBtRACY';  // Spreadsheet ID
    $range = 'Form Responses 1!A:Z';  // Range data di Google Sheets (kolom A hingga Z)

    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
   
   //dd($values);
    $firstRow = true;  // Variabel untuk mengecek baris pertama
 foreach ($values as $key => $row) {
    // Skip the first row (header row)
    if ($key == 0) continue;

    // Assuming that column 24 contains the number_plate, checking if it's already in the database
    $numberPlate = isset($row[24]) && !empty($row[24]) ? $row[24] : null;  // Column X (Number Plate)

    // If number_plate is missing, continue to next row
    if (!$numberPlate) {
        continue;
    }

    // Assuming that column 7 contains the permit number, checking if it's already in the database
    $permitNumber = isset($row[7]) ? $row[7] : null;  // Column H (Permit Number)
    $vendor = Vendor::where('permit_number', $permitNumber)->first();

    // If vendor doesn't exist, create a new one
    if (!$vendor) {
        Vendor::create([
            'company_name' => isset($row[1]) ? $row[1] : null,  // Column B (Company Name)
            'requestor_name' => isset($row[2]) ? $row[2] : null,  // Column C (Requestor Name)
            'location_of_work' => isset($row[3]) ? $row[3] : null,  // Column D (Location of Work)
            'building_level_room' => isset($row[4]) ? $row[4] : null,  // Column E (Building/Level/Room)
            'work_description' => isset($row[5]) ? $row[5] : null,  // Column F (Work Description)
            'email' => isset($row[19]) ? $row[19] : null,  // Column T (Email)
            'phone_number' => isset($row[20]) ? $row[20] : null,  // Column U (Phone Number)
            'permit_number' => $permitNumber,  // Column H (Permit Number)
            'start_date' => isset($row[21]) ? $row[21] : null,  // Column V (Start Date)
            'end_date' => isset($row[22]) ? $row[22] : null,  // Column W (End Date)
            'number_plate' => $numberPlate,  // Column X (Number Plate)
            'vehicle_types' => isset($row[25]) ? $row[25] : null,  // Column Z (Vehicle Types)
            'worker1_name' => isset($row[6]) ? $row[6] : null,  // Column G (Worker 1 Name)
            'worker1_id_nopermit' => isset($row[7]) ? $row[7] : null,  // Column H (Worker 1 ID No/Permit No)
            'worker2_name' => isset($row[8]) ? $row[8] : null,  // Column I (Worker 2 Name)
            'worker2_id_nopermit' => isset($row[9]) ? $row[9] : null,  // Column J (Worker 2 ID No/Permit No)
            'worker3_name' => isset($row[10]) ? $row[10] : null,  // Column K (Worker 3 Name)
            'worker3_id_nopermit' => isset($row[11]) ? $row[11] : null,  // Column L (Worker 3 ID No/Permit No)
            'worker4_name' => isset($row[12]) ? $row[12] : null,  // Column M (Worker 4 Name)
            'worker4_id_nopermit' => isset($row[13]) ? $row[13] : null,  // Column N (Worker 4 ID No/Permit No)
            'worker5_name' => isset($row[14]) ? $row[14] : null,  // Column O (Worker 5 Name)
            'worker5_id_nopermit' => isset($row[15]) ? $row[15] : null,  // Column P (Worker 5 ID No/Permit No)
            'generate_dust' => isset($row[16]) ? $row[16] : null,  // Column Q (Does work generate dust?)
            'protection_system' => isset($row[17]) ? $row[17] : null,  // Column R (Protection System)
            'file_mos' => isset($row[23]) ? $row[23] : null,  // Column W (Method of Statement)
            'status_approval_DHI' => false,  // Default to false
            'status_approval_FH' => false,  // Default to false
            'mode' => isset($row[18]) ? $row[18] : null,  // Column S (Urgency)
        ]);
    }
}

return view('home', compact('values'));

}

}
