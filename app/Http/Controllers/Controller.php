<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Vendor_Visitor;
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

        $spreadsheetId = '1dak8fWnKPc58hTm5QAxLmqr92L3vBW4WQLRKDEL_L20';  // Spreadsheet ID
        $range = 'Form Responses 1!A:BD';  // Range data di Google Sheets (kolom A hingga Z)

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

;        // Proses data setiap baris
        foreach ($values as $key => $row) {
            if ($key == 0) continue;  // Skip header row


            // Ambil primary_number yang sudah ada di Google Sheets (asumsi kolom 10 untuk primary_number)
            $primary_number = isset($row[55]) ? $row[55] : null;

            // Validasi apakah primary_number sudah ada di database
            $vendor = Vendor::where('primary_number', $primary_number)->first();

         //  $startDate = isset($row[21]) ? Carbon::createFromFormat('d/m/Y', $row[21])->format('Y-m-d') : null;  // Column V
        //   $endDate = isset($row[22]) ? Carbon::createFromFormat('d/m/Y', $row[22])->format('Y-m-d') : null;  // Column W
            if (!$vendor) {
             $vendor = Vendor::create([
    'email' => isset($row[1]) ? $row[1] : null,
    'validity_date_from' => isset($row[2]) ? $row[2] : null,
    'validity_date_to' => isset($row[3]) ? $row[3] : null,
    'validity_time_from' => isset($row[4]) ? $row[4] : null,
    'validity_time_to' => isset($row[5]) ? $row[5] : null,
    'company_name' => isset($row[6]) ? $row[6] : null,
    'requestor_name' => isset($row[7]) ? $row[7] : null,
    'company_contact' => isset($row[8]) ? $row[8] : null,
    'phone_number' => isset($row[9]) ? $row[9] : null,
    'location_of_work' => isset($row[10]) ? $row[10] : null,
    'building_level_room' => isset($row[11]) ? $row[11] : null,
    'purpose' => isset($row[12]) ? $row[12] : null,
    'purpose_details' => isset($row[13]) ? $row[13] : null,
    'total_worker' => isset($row[14]) ? $row[14] : null,
    'worker1_name' => isset($row[15]) ? $row[15] : null,
    'worker1_id_card' => isset($row[16]) ? $row[16] : null,
    'worker1_birthdate' => isset($row[17]) ? $row[17] : null,
    'worker2_name' => isset($row[18]) ? $row[18] : null,
    'worker2_id_card' => isset($row[19]) ? $row[19] : null,
    'worker2_birthdate' => isset($row[20]) ? $row[20] : null,
    'worker3_name' => isset($row[21]) ? $row[21] : null,
    'worker3_id_card' => isset($row[22]) ? $row[22] : null,
    'worker3_birthdate' => isset($row[23]) ? $row[23] : null,
    'worker4_name' => isset($row[24]) ? $row[24] : null,
    'worker4_id_card' => isset($row[25]) ? $row[25] : null,
    'worker4_birthdate' => isset($row[26]) ? $row[26] : null,
    'worker5_name' => isset($row[27]) ? $row[27] : null,
    'worker5_id_card' => isset($row[28]) ? $row[28] : null,
    'worker5_birthdate' => isset($row[29]) ? $row[29] : null,
    'worker6_name' => isset($row[30]) ? $row[30] : null,
    'worker6_id_card' => isset($row[31]) ? $row[31] : null,
    'worker6_birthdate' => isset($row[32]) ? $row[32] : null,
    'worker7_name' => isset($row[33]) ? $row[33] : null,
    'worker7_id_card' => isset($row[34]) ? $row[34] : null,
    'worker7_birthdate' => isset($row[35]) ? $row[35] : null,
    'worker8_name' => isset($row[36]) ? $row[36] : null,
    'worker8_id_card' => isset($row[37]) ? $row[37] : null,
    'worker8_birthdate' => isset($row[38]) ? $row[38] : null,
    'worker9_name' => isset($row[39]) ? $row[39] : null,
    'worker9_id_card' => isset($row[40]) ? $row[40] : null,
    'worker9_birthdate' => isset($row[41]) ? $row[41] : null,
    'worker10_name' => isset($row[42]) ? $row[42] : null,
    'worker10_id_card' => isset($row[43]) ? $row[43] : null,
    'worker10_birthdate' => isset($row[44]) ? $row[44] : null,
    'generate_dust' => isset($row[45]) ? $row[45] : null,
    'state_cause' => isset($row[46]) ? $row[46] : null,
    'method' => isset($row[47]) ? $row[47] : null,
    'any_fire' => isset($row[48]) ? $row[48] : null,
    'isolation_of' => isset($row[49]) ? $row[49] : null,
    'isolation_name' => isset($row[50]) ? $row[50] : null,
    'isolation_date' => isset($row[51]) ? $row[51] : null,
    'file_mos' => isset($row[52]) ? $row[52] : null,
    'number_plate' => isset($row[53]) ? $row[53] : null,
    'vehicle_types' => isset($row[54]) ? $row[54] : null,
    'primary_number' => $primary_number,

    'status' => 'Pending',
    'mode' => 'Normal',
]);


            $id_vendor = $vendor->id_vendor;


            Vendor_Visitor::create([
                  'id_vendor' => $id_vendor,
                  'type' => 'Vendor',
                  'mode' => 'Normal',

                    ]);
            }

        }}
     private function generatePrimaryNumber()
    {
        // Misalnya menggunakan timestamp untuk membuat ID unik
        return 'PN-' . time();  // Contoh: PN-1654092780
    }
    }
