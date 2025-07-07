<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Work Request Report</title>
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
  <h2>Work Request Report</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Permit No.</th>
        <th>Company</th>
        <th>Work Name</th>
        <th>Work ID Card</th>

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
        <td>{{$item->vendor->permit_number ?? ''}}</td>
        <td>{{$item->vendor->company_name ?? ''}}</td>
        <td>{{$item->name ?? ''}}</td>
        <td>{{$item->id_card ?? ''}}</td>

<td>{{ \Carbon\Carbon::parse($item->vendor->validity_date_from ?? '')->format('d/m/y') }}</td>
<td>{{ \Carbon\Carbon::parse($item->vendor->validity_date_to ?? '')->format('d/m/y') }}</td>



        <td>Work</td>
        <td>{{$item->vendor->work_description ?? ''}}</td>
        <td>{{$item->vendor->specific_location ?? ''}}</td>
        <td>{{$item->vendor->isolation_name ?? ''}}</td>
        <td>{{$item->vendor->number_plate ?? ''}}</td>
        <td>{{$item->vendor->status ?? ''}}</td>
<td>{{ \Carbon\Carbon::parse($item->vendor->updated_at ?? '')->format('d/m/y') }}</td>


      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
