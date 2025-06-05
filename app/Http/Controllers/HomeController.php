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
        parent::__construct();
        $this->middleware('auth');  // Pastikan user sudah terautentikasi

    $this->middleware(function ($request, $next) {
        $user = auth()->user();

        // Jika role disimpan di kolom 'role', misalnya
        if (!in_array($user->role, ['Vendor', 'Visitor'])) {
            abort(403, 'You do not have the required role to access this page.');
        }

        return $next($request);
    });

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

  public function index()
{
     $approvedCount = Vendor::where('status', 'Approved')->count();
     $PendingCount = Vendor::where('status', 'Pending')->count();
     $RejectCount = Vendor::where('status', 'Reject')->count();
      $allPermit = Vendor::count();


    return view('home',[
        'approvedCount' => $approvedCount,
        'PendingCount' => $PendingCount,
        'allPermit' => $allPermit,
        'RejectCount' => $RejectCount
    ]);
}



}
