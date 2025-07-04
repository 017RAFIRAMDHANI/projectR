<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Historisafeti;
use App\Models\Safeti;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SafetiController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');


    }


public function uploadPhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|max:2048',
        'id_safeti' => 'required|integer',
    ]);

    $safeti = Safeti::findOrFail($request->id_safeti);

    // Hapus file lama jika ada
    if ($safeti->file_gambar && Storage::disk('public')->exists($safeti->file_gambar)) {
        Storage::disk('public')->delete($safeti->file_gambar);
    }

    // Upload file baru
    $path = $request->file('photo')->store('photos', 'public');

    // Simpan path baru
    $safeti->file_gambar = $path;
    $safeti->save();

    return response()->json([
        'success' => true,
        'photo_url' => asset('storage/' . $path)
    ]);
}


    public function reset(Request $request){
        $dataReset = Safeti::where('id_safeti', $request->id_safeti)->first();

        $dataReset->update([
             "start_date" => null,
             "expired_date" => null,
             "status_safeti" => "Inactive",

           'lampu_green'=> null,
           'lampu_yellow'=> null,
           'lampu_red'=> null,
           'catatan_lampu_green'=> null,
           'catatan_lampu_yellow'=> null,
           'catatan_lampu_red'=> null,
           'date_lampu_green'=> null,
           'date_lampu_yellow'=> null,
           'date_lampu_red'=> null,
           'file_gambar'=> null,
        ]);


         Histori::create([
             'id_data' => $dataReset->id_safeti ?? null,
             'id_akun' => Auth::user()->id ?? null,
             'type' => "Employee Safety Reset",
              'judul' => "Employee Safety Is Reset",
             'text' => "Successful employee safety is reset behalf of  " . $dataReset->name ?? null,
]);

        if($dataReset){
               return redirect()->back()->with('success', 'Reset successfully!');
        }else{
               return redirect()->back()->with('error', 'Reset failled!');
        }
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

  public function index(Request $request)
{
    if (Auth::user()->access_safety_view !== 1) {

        return back()->with('error','contact DHI for further access');
    }

    $searchFilter = $request->input('searchFilterInput');
    $typeFilterPilihan = $request->input('typeFilterPilihan');
    $PilihStatus = $request->input('PilihStatus');
    $expired30Filter = $request->input('expired30Filter');
    $expiredDateInput1 = $request->input('expiredDateInput1');
    $expiredDateInput2 = $request->input('expiredDateInput2');


    $safetis = Safeti::with(['vendor', 'visitor', 'employe']);

    // Filter hanya relasi yang aktif
    $safetis = $safetis->where(function ($query) {
        $query->whereHas('vendor', function ($q) {
            $q->where('status_aktif', 'Active');
        })->orWhereHas('visitor', function ($q) {
            $q->where('status_aktif', 'Active');
        })->orWhereHas('employe', function ($q) {
            $q->where('status', 'Active');
        });
    });

    // Filter berdasarkan input search
    if ($searchFilter) {
        $safetis = $safetis->where(function ($query) use ($searchFilter) {
            $query->where('name', 'like', '%' . $searchFilter . '%')
                ->orWhere('company_name', 'like', '%' . $searchFilter . '%')
                ->orWhere('start_date', 'like', '%' . $searchFilter . '%')
                ->orWhere('type', 'like', '%' . $searchFilter . '%')
                ->orWhere('expired_date', 'like', '%' . $searchFilter . '%');
        });
    }
       if ($typeFilterPilihan) {
        $safetis = $safetis->where(function($query) use ($typeFilterPilihan) {
            $query->where('type', 'like', '%' . $typeFilterPilihan . '%');

        });
    }


if ($expired30Filter == "expired30") {
    $today = Carbon::now(); // Mendapatkan tanggal saat ini
    $startDate = $today->copy();  // Menggunakan tanggal hari ini
    $endDate = $today->copy()->addDays(30); // Menghitung tanggal 30 hari ke depan dari hari ini
    $safetis = $safetis->where(function($query) use ($startDate, $endDate) {
        // Filter berdasarkan rentang tanggal: hari ini hingga 30 hari ke depan
        $query->whereDate('expired_date', '>=', $startDate) // Mulai dari hari ini
        ->whereDate('expired_date', '<=', $endDate);   // Hingga 30 hari ke depan
        // Menambahkan kondisi status_safeti == "Expired"
        // ->where('status_safeti', 'Expired');
        // dd($query);
    });
}
  if ($expired30Filter == "expiredBefore") {
    // Pastikan expiredDateInput1 dan expiredDateInput2 dalam format yang benar
    $startDate = Carbon::parse($expiredDateInput1); // Mengubah expiredDateInput1 menjadi objek Carbon
    $endDate = Carbon::parse($expiredDateInput2); // Mengubah expiredDateInput2 menjadi objek Carbon

    // Filter berdasarkan rentang tanggal antara expiredDateInput1 dan expiredDateInput2
    $safetis = $safetis->where(function($query) use ($startDate, $endDate) {
        $query->whereDate('expired_date', '>=', $startDate)
              ->whereDate('expired_date', '<=', $endDate)
              // Menambahkan kondisi status_safeti == "Expired"
                ->where('status_safeti', 'Active');
    });
}
  if ($expired30Filter == "expiredAfter") {
    // Pastikan expiredDateInput1 dan expiredDateInput2 dalam format yang benar
    $startDate = Carbon::parse($expiredDateInput1); // Mengubah expiredDateInput1 menjadi objek Carbon
    $endDate = Carbon::parse($expiredDateInput2); // Mengubah expiredDateInput2 menjadi objek Carbon

    // Filter berdasarkan rentang tanggal antara expiredDateInput1 dan expiredDateInput2
    $safetis = $safetis->where(function($query) use ($startDate, $endDate) {
        $query->whereDate('expired_date', '>=', $startDate)
              ->whereDate('expired_date', '<=', $endDate)
              // Menambahkan kondisi status_safeti == "Expired"
                ->where('status_safeti', 'Expired');
    });
}

      if ($PilihStatus) {
    $safetis = $safetis->where('status_safeti', '=', $PilihStatus);
}


    // Pagination
    $safetis = $safetis->paginate(20);


   $allSafetis = Safeti::all();

    foreach ($allSafetis as $safety) {
        // Pastikan expired_date tidak kosong dan valid
        if (!empty($safety->expired_date) && $safety->status_safeti === 'Active') {
            try {
                $expiredDate = Carbon::parse($safety->expired_date);

                // Pastikan format tanggal valid dan periksa apakah tanggal expired lebih kecil dari tanggal sekarang
                if ($expiredDate->isBefore(now()->toDateString())) {
                    $safety->status_safeti = 'Expired';
                    $safety->save();

                      Histori::create([
             'id_data' => $safety->id_safeti ?? null,
             'id_akun' => Auth::user()->id ?? null,
             'type' => "Employee Safety Expired",
              'judul' => "Employee Safety Is Expired",
             'text' => "Employee safety is expired behalf of  " . $safety->name ?? null,
]);

                }
            } catch (\Exception $e) {
                // Jika format tanggal invalid, log error atau lakukan penanganan yang diperlukan
                // Bisa menambahkan log untuk debugging
                Log::error("Invalid expired date format for safeti ID: " . $safety->id . " Error: " . $e->getMessage());
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

         Histori::create([
             'id_data' => $safety->id_safeti ?? null,
             'id_akun' => Auth::user()->id ?? null,
             'type' => "Employee Safety",
              'judul' => "Employee Safety Is On",
             'text' => "Successful employee safety is on behalf of  " . $safety->name ?? null,
]);

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

    $safety->$noteField = $request->note ?? null;
    $safety->$dateField = $request->date ?? null;
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
    if($ishistori == "yes" || ($request->lampu === 'yellow' && $request->iskuning == "yes")){
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


        $statusLampu = $request->status;

        if ($statusLampu == 'Active') {

              Histori::create([
                'id_data' => $safety->id_safeti ?? null,
                'id_akun' => Auth::user()->id ?? null,
                'type' => "Employee Safety Freedoms",
                'judul' => "Employees Get Freedoms",
                'text' => "Employee gets " . $request->lampu . " freedom in the name of " . ($safety->name ?? 'unknown')
            ]);

        } else {

            if($request->ismerah == "yes"){

          if($request->lampu === 'red'){


          Histori::create([
                'id_data' => $safety->id_safeti ?? null,
                'id_akun' => Auth::user()->id ?? null,
                'type' => "Employee Safety Violations",
                'judul' => "Employees Get Violations",
                'text' => "Employee gets " . $request->lampu . " violation in the name of " . ($safety->name ?? 'unknown')
            ]);
         }
        }else if($request->iskuning == "yes"){

    if($request->lampu === 'yellow'){


          Histori::create([
                'id_data' => $safety->id_safeti ?? null,
                'id_akun' => Auth::user()->id ?? null,
                'type' => "Employee Safety Violations",
                'judul' => "Employees Get Violations",
                'text' => "Employee gets " . $request->lampu . " violation in the name of " . ($safety->name ?? 'unknown')
            ]);
         }

        }



        else{

          Histori::create([
                'id_data' => $safety->id_safeti ?? null,
                'id_akun' => Auth::user()->id ?? null,
                'type' => "Employee Safety Violations",
                'judul' => "Employees Get Violations",
                'text' => "Employee gets " . $request->lampu . " violation in the name of " . ($safety->name ?? 'unknown')
            ]);
        }

 }
    return response()->json(['success' => true]);
}

}
