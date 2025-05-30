<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Google_Client;
use Google_Service_Sheets;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

       public function __construct()
    {
        $this->fetchData(); // Menambahkan fungsi untuk memanggil data setiap kali controller dipanggil
    }

    public function fetchData()
    {
        $client = new Google_Client();
        $client->setAuthConfig(config('google.credentials_path'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $service = new Google_Service_Sheets($client);

        $spreadsheetId = '1XsY2nAyvprk8vg72SjYwW1nn1pfLI4ekAKNZUBtRACY';  // Spreadsheet ID
        $range = 'Form Responses 1!A:Z';  // Range data di Google Sheets (kolom A hingga Z)

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

;        // Proses data setiap baris
        foreach ($values as $key => $row) {
            if ($key == 0) continue;  // Skip header row

            $numberPlate = isset($row[24]) && !empty($row[24]) ? $row[24] : null;  // Column X (Number Plate)

            if (!$numberPlate) {
                continue;
            }

            $permitNumber = isset($row[7]) ? $row[7] : null;  // Column H (Permit Number)
            $vendor = Vendor::where('permit_number', $permitNumber)->first();
           $startDate = isset($row[21]) ? Carbon::createFromFormat('d/m/Y', $row[21])->format('Y-m-d') : null;  // Column V
           $endDate = isset($row[22]) ? Carbon::createFromFormat('d/m/Y', $row[22])->format('Y-m-d') : null;  // Column W
            if (!$vendor) {
                Vendor::create([
                    'company_name' => isset($row[1]) ? $row[1] : null,  // Column B (Company Name)
                    'requestor_name' => isset($row[2]) ? $row[2] : null,  // Column C (Requestor Name)
                    'location_of_work' => isset($row[3]) ? $row[3] : null,  // Column D (Location of Work)
                    'building_level_room' => isset($row[4]) ? $row[4] : null,  // Column E (Building/Level/Room)
                    'work_description' => isset($row[5]) ? $row[5] : null,  // Column F (Work Description)
                    'email' => isset($row[19]) ? $row[19] : null,  // Column T (Email)
                    'phone_number' => isset($row[20]) ? $row[20] : null,  // Column U (Phone Number)
                    'permit_number' => $permitNumber,  // Column H
                    'start_date' => $startDate,  // Column V
                    'end_date' => $endDate,  // Column W
                    'number_plate' => $numberPlate,  // Column X
                    'vehicle_types' => isset($row[25]) ? $row[25] : null,  // Column Z
                    'worker1_name' => isset($row[6]) ? $row[6] : null,  // Column G
                    'worker1_id_nopermit' => isset($row[7]) ? $row[7] : null,  // Column H
                    'worker2_name' => isset($row[8]) ? $row[8] : null,  // Column I
                    'worker2_id_nopermit' => isset($row[9]) ? $row[9] : null,  // Column J
                    'worker3_name' => isset($row[10]) ? $row[10] : null,  // Column K
                    'worker3_id_nopermit' => isset($row[11]) ? $row[11] : null,  // Column L
                    'worker4_name' => isset($row[12]) ? $row[12] : null,  // Column M
                    'worker4_id_nopermit' => isset($row[13]) ? $row[13] : null,  // Column N
                    'worker5_name' => isset($row[14]) ? $row[14] : null,  // Column O
                    'worker5_id_nopermit' => isset($row[15]) ? $row[15] : null,  // Column P
                    'generate_dust' => isset($row[16]) ? $row[16] : null,  // Column Q
                    'protection_system' => isset($row[17]) ? $row[17] : null,  // Column R
                    'file_mos' => isset($row[23]) ? $row[23] : null,  // Column W
                    'status_approval_DHI' => false,  // Default false
                    'status_approval_FH' => false,  // Default false
                    'mode' => isset($row[18]) ? $row[18] : null,  // Column S (Urgency)
                ]);
            }

        }}}
