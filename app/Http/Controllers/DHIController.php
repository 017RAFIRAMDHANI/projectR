<?php

namespace App\Http\Controllers;

use App\Models\Approved;
use App\Models\Employe;
use App\Models\Histori;
use App\Models\Safeti;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DHIController extends Controller
{
          public function __construct()
    {
        $this->middleware('auth');


    }
    public function index(){
 $dataAktifitas = Histori::where('id_akun', Auth::user()->id)
                            ->orderBy('created_at', 'desc')  // Mengurutkan berdasarkan waktu terbaru (descending)
                            ->limit(5)  // Batasi hanya 5 data terbaru
                            ->get();
    $jmlEmploye = Employe::where('status','Active')->count();  // Menghitung jumlah total karyawan
    $jmlVehicle = Vehicle::where('status','Active')->count();  // Menghitung jumlah total karyawan

        $dataVendor = Vendor::whereNull('permit_number')  // Memilih data yang belum memiliki number_permit
                    ->orderByRaw("FIELD(mode, 'Urgent') DESC")  // Urutkan berdasarkan mode (urgent di atas normal)
                    ->orderBy('created_at', 'desc')  // Anda bisa menambahkan urutan tambahan jika perlu
                    ->limit(5)  // Membatasi hasil hanya 5 data
                    ->get();
$dataVisitor = Visitor::whereNull('permit_number')  // Memilih data yang belum memiliki number_permit
                    ->orderBy('created_at', 'desc')  // Anda bisa menambahkan urutan tambahan jika perlu
                    ->limit(5)  // Membatasi hasil hanya 5 data
                    ->get();

                     $dataAktifPermit =  Approved::where('status','Open')->count();

  $safetis = Safeti::with(['vendor', 'visitor', 'employe']);

  $today = Carbon::now();
    $startDate = $today->copy();
    $endDate = $today->copy()->addDays(30); // Menghitung tanggal 30 hari ke depan dari hari ini
    $safetiCount = $safetis->where(function($query) use ($startDate, $endDate) {
        // Filter berdasarkan rentang tanggal: hari ini hingga 30 hari ke depan
        $query->whereDate('expired_date', '>=', $startDate) // Mulai dari hari ini
        ->whereDate('expired_date', '<=', $endDate);   // Hingga 30 hari ke depan


    })->count();


                     $dataAktifPermitT =  Approved::where('status','Open')
                     ->whereDate('created_at', Carbon::today())->count();
                     $jmlEmployeT = Employe::whereDate('created_at',Carbon::today())->count();
                 $jmlVehicleT = Vehicle::whereDate('created_at', Carbon::today())->count();

       return view('dhi-dashboard', compact('safetiCount','dataAktifPermitT','dataAktifPermit','dataAktifitas','jmlEmploye','jmlVehicle','jmlEmployeT','jmlVehicleT','dataVendor','dataVisitor'));  // Mengirimkan data ke view

    }
}
