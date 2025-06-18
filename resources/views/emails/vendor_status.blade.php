<!DOCTYPE html>
<html>
<head>
    <title>Vendor Status Update</title>
</head>
<body>
    <h2>Dear {{ $vendorName }}</h2>

    <p>Your vendor request has been <strong>{{ $status }}</strong>.</p>
    <br>
     @if ($status == 'Rejected')
    <p>{{$note_vendor ?? ''}}</p>
    @endif
    @if ($status == 'Approved')
        <p>Your permit number is: <strong>{{ $permitNumber }}</strong></p>
    @endif

    <p>Thank you for your cooperation!</p>
</body>
</html>
