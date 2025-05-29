<?php

namespace App\Console;

use App\Models\Vendor;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Google_Client;
use Google_Service_Sheets;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
protected function schedule(Schedule $schedule)
{
    // Menjalankan perintah untuk mengambil dan menyimpan data dari Google Sheets
    $schedule->call(function () {
        $client = new Google_Client();
        $client->setAuthConfig(config('google.credentials_path'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $service = new Google_Service_Sheets($client);

        $spreadsheetId = '1XsY2nAyvprk8vg72SjYwW1nn1pfLI4ekAKNZUBtRACY';
        $range = 'Form Responses 1!A:Z';

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        foreach ($values as $key => $row) {
            if ($key == 0) continue;

            $numberPlate = isset($row[24]) && !empty($row[24]) ? $row[24] : null;

            if (!$numberPlate) {
                continue;
            }

            $permitNumber = isset($row[7]) ? $row[7] : null;
            $vendor = Vendor::where('permit_number', $permitNumber)->first();

            if (!$vendor) {
                Vendor::create([
                    'company_name' => isset($row[1]) ? $row[1] : null,
                    'requestor_name' => isset($row[2]) ? $row[2] : null,
                    'location_of_work' => isset($row[3]) ? $row[3] : null,
                    'building_level_room' => isset($row[4]) ? $row[4] : null,
                    'work_description' => isset($row[5]) ? $row[5] : null,
                    'email' => isset($row[19]) ? $row[19] : null,
                    'phone_number' => isset($row[20]) ? $row[20] : null,
                    'permit_number' => $permitNumber,
                    'start_date' => isset($row[21]) ? $row[21] : null,
                    'end_date' => isset($row[22]) ? $row[22] : null,
                    'number_plate' => $numberPlate,
                    'vehicle_types' => isset($row[25]) ? $row[25] : null,
                    'worker1_name' => isset($row[6]) ? $row[6] : null,
                    'worker1_id_nopermit' => isset($row[7]) ? $row[7] : null,
                    'worker2_name' => isset($row[8]) ? $row[8] : null,
                    'worker2_id_nopermit' => isset($row[9]) ? $row[9] : null,
                    'worker3_name' => isset($row[10]) ? $row[10] : null,
                    'worker3_id_nopermit' => isset($row[11]) ? $row[11] : null,
                    'worker4_name' => isset($row[12]) ? $row[12] : null,
                    'worker4_id_nopermit' => isset($row[13]) ? $row[13] : null,
                    'worker5_name' => isset($row[14]) ? $row[14] : null,
                    'worker5_id_nopermit' => isset($row[15]) ? $row[15] : null,
                    'generate_dust' => isset($row[16]) ? $row[16] : null,
                    'protection_system' => isset($row[17]) ? $row[17] : null,
                    'file_mos' => isset($row[23]) ? $row[23] : null,
                    'status_approval_DHI' => false,
                    'status_approval_FH' => false,
                    'mode' => isset($row[18]) ? $row[18] : null,
                ]);
            }
        }
    })->everyMinute();  // Setiap menit
}


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
