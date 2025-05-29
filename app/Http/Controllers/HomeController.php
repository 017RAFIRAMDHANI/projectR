<?php

namespace App\Http\Controllers;

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

$spreadsheetId = '1ENiCLN6KBPHW_syJbJqhhqmTtzWi4Q8wDQOrIOe0PBw';  // Your Spreadsheet ID
$range = 'Form Responses 1!A:S';

$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
// dd(count($values));  // Verify how many rows are fetched

return view('home', compact('values'));


}
}
