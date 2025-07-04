
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Request Form</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            background-color: white;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        .container {
            width: 100%;
            max-width: 190mm; /* Reduced from 210mm to fit within margins */
            margin: 0 auto;
            background-color: white;
            padding: 3mm;
            min-height: 270mm; /* Added to make form taller */
        }
  .header {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-bottom: 4px;
    border-bottom: none;  /* Menghapus garis border bawah */
    margin-bottom: 10px;  /* Menambahkan jarak bawah pada header */
    position: relative;
}

       .header .title {
    text-align: center;
    margin-left: 80px; /* Memberikan ruang agar teks tidak tumpang tindih dengan logo */
}
        .header .title h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
     .logo {
    position: absolute;
    top: 0;
    left: 0;
    height: 40px; /* Sesuaikan ukuran logo */
    margin-bottom: 30px; /* Menambah jarak bawah pada logo */
}

        .section-header {
            background-color: #002060;
            color: white;
            padding: 5px 8px;
            font-weight: bold;
            text-align: left;
            font-size: 11px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            table-layout: fixed; /* Added to prevent overflow */
        }
        td, th {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
            font-size: 11px;
            word-wrap: break-word;
            overflow: hidden;
        }
        .signature-box {
            height: 35px;
            text-align: center;
            vertical-align: middle;
            font-family: 'Segoe Script', 'Brush Script MT', cursive;
            font-size: 14px;
            color: #333;
            line-height: 35px;
        }
        .compact-row {
            height: 20px;
        }
        input[type="checkbox"] {
            margin: 0 2px;
            transform: scale(0.8);
        }
        strong {
            font-weight: bold;
        }
        /* Specific width adjustments for better fit */
        .main-info-table td:nth-child(1) { width: 16%; }
        .main-info-table td:nth-child(2) { width: 40%; }
        .main-info-table td:nth-child(3) { width: 18%; }
        .main-info-table td:nth-child(4) { width: 26%; }

        .visitor-table th:nth-child(1) { width: 50%; }
        .visitor-table th:nth-child(2) { width: 25%; }
        .visitor-table th:nth-child(3) { width: 25%; }

        .delivery-table th:nth-child(1) { width: 50%; }
        .delivery-table th:nth-child(2) { width: 25%; }
        .delivery-table th:nth-child(3) { width: 25%; }

        .person-charge-table td:nth-child(1) { width: 22%; }
        .person-charge-table td:nth-child(2) { width: 26%; }
        .person-charge-table td:nth-child(3) { width: 26%; }
        .person-charge-table td:nth-child(4) { width: 26%; }

        .approval-table td { width: 33.33%; }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
                background-color: white;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 2mm;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
       <div class="header">
@php
    // Mengambil gambar dan mengonversinya ke base64
    $logoPath = public_path('gambar/digital-hyperspace-logo.png');
    $logoBase64 = base64_encode(file_get_contents($logoPath));
    $logoSrc = 'data:image/png;base64,' . $logoBase64;
@endphp

<img src="{{ $logoSrc }}" alt="Digital Hyperspace Logo" class="logo">

    <div class="title">
        <h1>VISITOR REQUEST FORM</h1>
    </div>
</div>
<br>

        <div class="section-header">To be filled by requester</div>
        <table class="main-info-table">
            <tr>
                <td><strong>Company</strong></td>
                <td>{{$visitor->company_name}}</td>
                <td><strong>Permit No.:</strong></td>
                <td>{{$visitor->permit_number}}</td>
            </tr>
            @php
            use Illuminate\Support\Carbon;
                 $dateFrom = Carbon::parse($visitor->request_date_from);
                $dateTo = Carbon::parse($visitor->request_date_to);
                $duration = $dateFrom->diffInDays($dateTo);
            @endphp
            <tr>
                <td><strong>Requested Duration</strong></td>
                <td> {{$duration}} Day</td>
                {{-- belum dinamis --}}
                <td><strong>Requested Date</strong></td>
                <td>From: {{$visitor->request_date_from}} To: {{$visitor->request_date_to}}</td>
            </tr>
            <tr>
                <td><strong>Purpose</strong></td>
                <td>
                    <input type="checkbox" @if($visitor->purpose_visit == "Visitor") checked @endif> Visitor
                    <input type="checkbox" @if($visitor->purpose_visit == "Delivery") checked @endif> Delivery
                </td>
                <td><strong>Purpose Details:</strong></td>
                <td>{{$visitor->purpose_detail}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td><strong>Destination / Area:</strong>{{$visitor->specific_location}}</td>
            </tr>
        </table>

       <table class="visitor-table" style="margin-top: 3px; border-collapse: collapse; width: 100%; font-size: 10px;">
    <thead>
        <tr>
            <th class="section-header" style="border: 1px solid #000; padding: 4px;">If Visitor: Full Name & ID Card No</th>
            <th class="section-header" style="border: 1px solid #000; padding: 4px;">Full Name</th>
            <th class="section-header" style="border: 1px solid #000; padding: 4px;">ID Card</th>
        </tr>
    </thead>
    <tbody>
        @php $counter = 1; @endphp

        @for ($i = 1; $i <= 30; $i++)
            @php
                $visitorName = 'name_' . $i;
                $visitorId = 'id_card_' . $i;
                $nameValue = $visitor->$visitorName ?? '';
                $idValue = $visitor->$visitorId ?? '';
            @endphp

            @if(!empty($nameValue) || !empty($idValue))
                <tr>
 <td style="border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: none; border-top: none; padding: 4px;"></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $counter}}.{{$nameValue }}</td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $counter}}.{{$idValue }}</td>
                </tr>
                @php $counter++; @endphp
            @endif
        @endfor
    </tbody>
</table>


        <table class="delivery-table" style="margin-top: 3px;">
            <thead>
                <tr>
                    <th class="section-header">If Delivery: Details Materials & Quantity</th>
                    <th class="section-header">Materials</th>
                    <th class="section-header">Qty</th>
                </tr>
            </thead>
            <tbody>
        @php $counter = 1; @endphp

        @for ($i = 1; $i <= 30; $i++)
            @php
                $visitorName = 'material_' . $i;
                $visitorId = 'quantity_' . $i;
                $nameValue = $visitor->$visitorName ?? '';
                $idValue = $visitor->$visitorId ?? '';
            @endphp

            @if(!empty($nameValue) || !empty($idValue))
                <tr>
 <td style="border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: none; border-top: none; padding: 4px;"></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $counter}}.{{$nameValue }}</td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $counter}}.{{$idValue }}</td>
                </tr>
                @php $counter++; @endphp
            @endif
        @endfor
    </tbody>
        </table>

        <table class="person-charge-table" style="margin-top: 3px;">
             <tr>
                <td><strong>Person in Charge</strong></td>
                <td>Name: {{$visitor->pic_name}}</td>
                <td>Contact No: {{$visitor->pic_contact}}</td>
                <td>Car Plate: {{$visitor->car_plate_no}} ({{$visitor->vehicle_type}})</td>
             </tr>
        </table>

        <div class="section-header" style="margin-top: 3px;">
            To be filled by DHI/FM Team - Approved by: *minimum 1 approver is to sign off
        </div>
        <table class="approval-table">
            <tr>
                <td>Date: __ / __ / 20__</td>
                <td>Date: __ / __ / 20__</td>
                <td>Date: 14 / 04 / 2025</td>
            </tr>
            <tr>
                <td class="signature-box"></td>
                <td class="signature-box"></td>
                <td class="signature-box">{{$visitor->pdf_nama}}</td>
            </tr>
            <tr>
                <td style="font-size: 8px;"><strong>Barry Lau Hon Chung</strong><br>(Critical Facility Director)</td>
                <td style="font-size: 8px;"><strong>Stanley Go</strong><br>(Operation Manager)</td>
                <td style="font-size: 8px;"><strong>{{$visitor->pdf_nama}}</strong><br>(@if($visitor->pdf_jabatan == "FM") Facility Manager @else DHI @endif)</td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>Visitor Badge Color Assigned:</strong>
                    <input type="checkbox"> Yellow
                    <input type="checkbox"> Red
                    <input type="checkbox"> Green
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
