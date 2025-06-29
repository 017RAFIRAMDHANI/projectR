<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Visitor Request Report</title>
  <style>
    @page {
      size: A4 landscape; /* Change to landscape */
      margin: 12mm;
    }
    body {
      font-family: Arial, sans-serif;
      font-size: 11px;
      color: #222;
    }
    h2 {
      text-align: center;
      margin-bottom: 18px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border: 1px solid #333;
      padding: 6px 8px;
      text-align: left;
    }
    th {
      background: #f0f0f0;
    }
    .text-center {
      text-align: center;
    }
  </style>
</head>
<body>
  <h2>Visitor Request Report</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Permit No.</th>
        <th>Company</th>
        <th>Vendor Name</th>
        <th>Vendor ID Card</th>

        <th>Requested Date (From)</th>
        <th>Requested Date (To)</th>
        <th>Purpose</th>
        <th>Purpose Details</th>
        <th>Destination/Area</th>
        <th>Person in Charge</th>
        <th>Car Plate No</th>
        <th>Status</th>
        <th>Approval Date</th>
      </tr>
    </thead>
    <tbody>
        @php
            $i =1;
        @endphp
      @foreach ($dataPermit as $item)
      <tr>
        <td class="text-center">{{$i++}}</td>
        <td>{{$item->visitor->permit_number ?? ''}}</td>
        <td>{{$item->visitor->company_name ?? ''}}</td>
        <td>{{$item->name ?? ''}}</td>
        <td>{{$item->id_card ?? ''}}</td>

        <td>{{$item->visitor->request_date_from ?? ''}}</td>
        <td>{{$item->visitor->request_date_to ?? ''}}</td>



        <td>{{$item->visitor->purpose_visit ?? ''}}</td>
        <td>{{$item->visitor->purpose_detail ?? ''}}</td>
        <td>{{$item->visitor->specific_location ?? ''}}</td>
        <td>{{$item->visitor->pic_name ?? ''}}</td>
        <td>{{$item->visitor->car_plate_no ?? ''}}</td>
        <td>{{$item->visitor->status ?? ''}}</td>
        <td>{{$item->visitor->updated_at ?? ''}}</td>


      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
