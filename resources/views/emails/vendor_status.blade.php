<!DOCTYPE html>
<html>
<head>
    <title>Work Permit Status Update</title>
</head>
<body>
    <h2>Dear {{ $vendorName }}</h2>

    <p>Your work permit request has been <strong>{{ $status }}</strong>.</p>
    <br>

    <p>{{$note_vendor ?? ''}}</p>

    @if ($status == 'Approved')
        <p>Your permit number is: <strong>{{ $permitNumber }}</strong></p>
    @endif
    <p>Please be
reminded to bring the
ID Card submitted in
the application and
the approved visitor /
work permit
confirmation as
attached in this email
for security
verification on site.</p>
    <p>Thank you for your cooperation!</p>
</body>
</html>
