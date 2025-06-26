<?php

namespace App\Http\Controllers;

use App\Models\Historisafeti;
use App\Models\Safeti;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SafetiController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');


    }

 public function histori(Request $request)
{
    $idHistori = $request->id_history_safeti;
    $dataLain = Safeti::where('id_history_safeti',$idHistori)->first();

    // Ambil histori untuk dapatkan id_safeti nya
    $histori = Historisafeti::findOrFail($idHistori);

    // Sekarang ambil semua histori berdasarkan id_safeti
    $dataHistory = Historisafeti::where('id_safeti', $histori->id_safeti)->get();

    return view('history', [
        'dataHistory' => $dataHistory,
        'dataLain' => $dataLain,
    ]);
}

   public function index()
{
    $safetis = Safeti::with(['vendor', 'visitor', 'employe'])
        ->where(function($query) {
            $query->whereHas('vendor', function($q) {
                $q->where('status_aktif', 'Active');
            })->orWhereHas('visitor', function($q) {
                $q->where('status_aktif', 'Active');
            })->orWhereHas('employe', function($q) {
                $q->where('status', 'Active');
            });
        })
        ->get();

    $allSafetis = Safeti::all();

    foreach ($allSafetis as $safety) {
        if (
            !empty($safety->expired_date) &&
            $safety->status_safeti === 'Active'
        ) {
            $expiredDate = Carbon::parse($safety->expired_date);

            if ($expiredDate->isBefore(now()->toDateString())) {
                $safety->status_safeti = 'Expired';
                $safety->save();
            }
        }
    }
    return view('employee-safety-list', [
         'safetis' => $safetis
    ]);
}

    public function date(Request $request)
{
    $request->validate([
        'id_safeti'    => 'required',
        'status'       => 'required',
        'start_date'   => 'required',
        'expired_date' => 'required',
    ]);

    $safety = Safeti::find($request->id_safeti);
    $safety->status_safeti = $request->status;
    $safety->start_date = $request->start_date;
    $safety->expired_date = $request->expired_date;
    $safety->save();

    return response()->json(['success' => true, 'message' => 'Status & dates updated.']);
}

public function updateLampuStatus(Request $request)
{
 //  Log::info('Data masuk dari fetch:', $request->all());

    // Atau log lebih rinci
    // Log::debug('Isi id_safeti: ' . $request->id_safeti);
    // Log::debug('Lampu: ' . $request->lampu);
    // Log::debug('Nilai: ' . var_export($request->value, true));

    $request->validate([
        'id_safeti' => 'required',
        'lampu' => 'required',
        'value' => 'required',
    ]);

    $safety = Safeti::findOrFail($request->id_safeti);
    $field = 'lampu_' . $request->lampu;
   $ishistori = $request->ishistori;
   $ismerah = $request->ismerah;


    if ($request->has('status')) {
        $safety->status_safeti = $request->status;
    }
    $safety->$field = $request->value;

    if ($request->filled('status') && in_array($request->status, ['Active', 'Out', 'Expired', 'Inactive'])) {
        $safety->status_safeti = $request->status;
    }

if ($request->has('note') && $request->has('date')) {
    $noteField = 'catatan_lampu_' . $request->lampu;
    $dateField = 'date_lampu_' . $request->lampu;

    $safety->$noteField = $request->note;
    $safety->$dateField = $request->date;
}




    if ($ishistori == "yes" || ($request->lampu === 'red' && $request->ismerah == "yes")) {
        $histori = new Historisafeti();
        $histori->type = $safety->status_safeti ?? 'Active';
        $histori->jenis_lampu = $request->lampu;
        $histori->note = $request->note ?? '-';
        $histori->date_terbit = now();
        $histori->name = $safety->name ?? '-';
        $histori->position = $safety->position ?? '-';
        $histori->company = $safety->company ?? '-';
        $histori->id_safeti = $request->id_safeti;
        $histori->save();

        $safety->id_history_safeti = $histori->id_histori_safeti;

    }


 $safety->save();




    return response()->json(['success' => true]);
}

}
