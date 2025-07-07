
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permit to Work Form</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            background-color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 185mm;
            max-width: 95%;
            min-height: auto;
            margin: 0 auto;
            background-color: white;
            padding: 8mm;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .logo {
            height: 40px;
        }
        .title-section {
            text-align: left;
            margin-top: 20px;
        }
        .title-section h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 2px;
        }
        .notes-section ul {
            list-style: disc;
            margin: 10px 0 10px 20px;
            padding: 0;
        }
        .notes-section ul li span {
            color: red;
            font-weight: bold;
        }
        .notes-section .other-permits {
            margin-left: 20px;
        }
        .notes-section .other-permits p {
            margin: 0;
        }
        .notes-section .other-permits div {
            margin-left: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td, th {
            border: 1px solid #000;
            padding: 5px 5px;
            vertical-align: top;
        }
        .section-header {
            background-color: #d9d9d9;
            color: #000;
            padding: 4px 8px;
            font-weight: bold;
            text-align: left;
        }
        .section-header span {
            color: red;
        }
        .no-border { border: none; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .signature-box { height: 40px; }
        .checkbox-label {
            margin-right: 15px;
            display: inline-block;
            vertical-align: middle;
        }
        input[type="checkbox"] {
            margin: 2px 4px 2px 2px;
            vertical-align: middle;
        }
        .signature-font {
            font-family: 'Brush Script MT', 'Brush Script Std', cursive;
            font-size: 18px;
            vertical-align: middle;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
                background-color: white;
            }
            .container {
                width: 185mm;
                max-width: 95%;
                min-height: auto;
                margin: 0 auto;
                padding: 8mm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <img src="{{ public_path('gambar/digital-hyperspace-logo.png') }}" alt="Digital Hyperspace Logo" class="logo"> --}}
            @php
   //  Mengambil gambar dan mengonversinya ke base64
    $logoPath = public_path('gambar/digital-hyperspace-logo.png');
    $logoBase64 = base64_encode(file_get_contents($logoPath));
    $logoSrc = 'data:image/png;base64,' . $logoBase64;
@endphp

<img src="{{ $logoSrc }}" alt="Digital Hyperspace Logo" class="logo">
        </div>

        <table>
            <colgroup>
                <col style="width: 25%;">
                <col style="width: 25%;">
                <col style="width: 25%;">
                <col style="width: 25%;">
            </colgroup>
            <tr>
                <td colspan="4" style="padding: 5px 8px;">
                    <div class="title-section" style="margin-top: 0;">
                        <h1 style="margin: 0;">Permit to Work</h1>
                    </div>
                    <div class="notes-section" style="margin-top: 0;">
                        <ul>
                            <li>Permit application form may be obtained from Reception or Mail Room at level 1. (<span>Valid for three day</span>)</li>
                            <li>All PTW must be submitted 24 hours in advance to EZSVS reception.</li>
                            <li>All Safety measures and procedures must be incompliance at all times.</li>
                        </ul>
                        <div class="other-permits">
                            <p><strong>Note:</strong></p>
                            <p>Other Permits &ndash; If the work involve the following, please apply a separate permit attached to this PTW.</p>
                            <div>
                                a) Hot Work Permit<br>
                                b) Confined Space Permit<br>
                                c) Electrical System Permit
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><strong>Validity Date</strong></td>
<td>From: {{ \Carbon\Carbon::parse($vendor->validity_date_from)->format('d/m/Y') ?? 'N/A' }}</td>
<td>To: {{ \Carbon\Carbon::parse($vendor->validity_date_to)->format('d/m/Y') ?? 'N/A' }}</td>

                <td><strong>Permit No.</strong><br>{{$vendor->permit_number}}</td>
            </tr>
            <tr><td class="section-header" colspan="4">Part 1: Requested By</td></tr>
            <tr>
                <td><strong>Company Name</strong></td>
                <td>{{$vendor->company_name}}</td>
                <td><strong>Company Contact</strong></td>
                <td>{{$vendor->company_contact}}</td>
            </tr>
            <tr>
                <td><strong>Requestor Name</strong></td>
                <td>{{$vendor->requestor_name}}</td>
                <td><strong>Hand phone</strong></td>
                <td>{{$vendor->phone_number}}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Building / Level / Room</strong></td>
                <td colspan="2">{{$vendor->building}} / {{$vendor->level}}</td>
            </tr>
            <tr>
                <td><strong>Car Plate No (if any)</strong></td>
                <td>{{$vendor->number_plate}}</td>
                <td colspan="2"></td>
            </tr>

            <tr><td class="section-header" colspan="4">Part 2: Work Description (<span>Mandatory</span>)</td></tr>
            <tr><td colspan="4" style="height: 40px;">{{$vendor->work_description}}</td></tr>

            <tr><td class="section-header" colspan="4">Part 3: Worker's Particulars (<span>Attach workers name list if required</span>)</td></tr>
            <tr>
                <td colspan="2"><strong>Total No. of Workers at EZSVS site</strong></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="font-bold text-center">Name</td>
                <td class="font-bold text-center">ID No./Permit No.<br>Birthdate</td>
                <td class="font-bold text-center">Name</td>
                <td class="font-bold text-center">ID No./Permit No.<br>Birthdate</td>
            </tr>
                @for ($i = 1; $i <= 30; $i+=5)
            @php
                // Ambil data pekerja kiri dan kanan
                $workerLeftName1 = $vendor->{'worker' . $i . '_name'} ?? null;
                $workerLeftId1 = $vendor->{'worker' . $i . '_id_card'} ?? null;
                $workerLeftName2 = $vendor->{'worker' . ($i+1) . '_name'} ?? null;
                $workerLeftId2 = $vendor->{'worker' . ($i+1) . '_id_card'} ?? null;

                $workerRightName1 = $vendor->{'worker' . ($i+2) . '_name'} ?? null;
                $workerRightId1 = $vendor->{'worker' . ($i+2) . '_id_card'} ?? null;
                $workerRightName2 = $vendor->{'worker' . ($i+3) . '_name'} ?? null;
                $workerRightId2 = $vendor->{'worker' . ($i+3) . '_id_card'} ?? null;

                $workerLeftName3 = $vendor->{'worker' . ($i+4) . '_name'} ?? null;
                $workerLeftId3 = $vendor->{'worker' . ($i+4) . '_id_card'} ?? null;
                $workerRightName3 = $vendor->{'worker' . ($i+5) . '_name'} ?? null;
                $workerRightId3 = $vendor->{'worker' . ($i+5) . '_id_card'} ?? null;
            @endphp

            <!-- Cek apakah ada data pekerja di kiri dan kanan -->
            @if($workerLeftName1 && $workerLeftId1 && $workerLeftName2 && $workerLeftId2)
                <tr>
                    <td>{{ $workerLeftName1 }}</td>
                    <td>{{ $workerLeftId1 }}</td>
                    <td>{{ $workerLeftName2 }}</td>
                    <td>{{ $workerLeftId2 }}</td>
                </tr>
            @endif

            @if($workerRightName1 && $workerRightId1 && $workerRightName2 && $workerRightId2)
                <tr>
                    <td>{{ $workerRightName1 }}</td>
                    <td>{{ $workerRightId1 }}</td>
                    <td>{{ $workerRightName2 }}</td>
                    <td>{{ $workerRightId2 }}</td>
                </tr>
            @endif

            @if($workerLeftName3 && $workerLeftId3)
                <tr>
                    <td>{{ $workerLeftName3 }}</td>
                    <td>{{ $workerLeftId3 }}</td>
                    <td>{{ $workerRightName3 ?? '' }}</td>
                    <td>{{ $workerRightId3 ?? '' }}</td>
                </tr>
            @endif
        @endfor

            <tr><td class="section-header" colspan="4">Part 4: Dust Control / Fire Alarm Isolation</td></tr>
            <tr>
                <td colspan="2"><strong>Does work generate dust ?</strong></td>
                <td><input type="checkbox" @if($vendor->generate_dust == "Yes") checked @endif> Yes</td>
                <td><input type="checkbox" @if($vendor->generate_dust == "No") checked @endif> No &nbsp;&nbsp;&nbsp; If YES, state cause</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px;"><strong>Method to contain dust / SD:</strong></td>
            </tr>
             <tr>
                <td colspan="4"><strong>Any Fire Protection System affected? e.g. Smoke detector, Sprinkler system.</strong> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" @if($vendor->fire_system == "Yes") checked @endif> Yes <input type="checkbox" @if($vendor->fire_system == "No") checked @endif> No</td>
            </tr>
            <tr>
                <td colspan="2">
    <strong>Isolation of :</strong>
    <label class="checkbox-label">
        <input type="checkbox"
            {{ strpos($vendor->isolation_of, 'Fire Panel') !== false ? 'checked' : '' }}> Fire Panel
    </label>
    <label class="checkbox-label">
        <input type="checkbox"
            {{ strpos($vendor->isolation_of, 'Smoke Detector') !== false ? 'checked' : '' }}> Smoke Detector
    </label>
    <label class="checkbox-label">
        <input type="checkbox"
            {{ strpos($vendor->isolation_of, 'Sprinkler') !== false ? 'checked' : '' }}> Sprinkler
    </label>
    <label class="checkbox-label">
        <input type="checkbox"
            {{ strpos($vendor->isolation_of, 'ASDS') !== false ? 'checked' : '' }}> ASDS
    </label>
</td>

                <td colspan="2"></td>
            </tr>
           <tr>
    <td colspan="2"><strong>Isolated by Name: {{$vendor->isolation_name}}</strong></td>
    <td colspan="2"><strong>Date/Time: {{ \Carbon\Carbon::parse($vendor->isolation_date)->format('d/m/Y H:i:s') ?? 'N/A' }}</strong></td>
</tr>

<tr><td class="section-header" colspan="4">Part 5: Approval - By Facility Manager</td></tr>
<tr>
    <td colspan="2"><strong>Name:</strong> {{$vendor->pdf_nama}}</td>
    <td colspan="2"><strong>Date/Time:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</td>
</tr>

        </table>

        <div class="notes-section" style="font-size: 8px; margin-top: 5px;">
             <strong>Note:</strong>
             <ol style="list-style-type: decimal; margin-left: 15px;">
                <li>Requestor or its contractor shall retain an approved copy of this PTW onsite whilst work is on-going.</li>
                <li>All works shall be in accordance with EZSVS Cable Management Procedure.</li>
                <li>The applicants and all their worker have read and understood EZSVS Facility Rules & Regulation.</li>
             </ol>
             All appropriate signatures must be obtained before work commences.
        </div>
    </div>
</body>
</html>
