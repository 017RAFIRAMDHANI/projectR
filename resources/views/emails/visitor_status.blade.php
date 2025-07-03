<!DOCTYPE html>
<html>
<head>
    <title>Visitor Status Update</title>
</head>
<body>
    <h2>Dear {{ $visitorName }}</h2>

    <p>Your Visitor request has been <strong>{{ $status }}</strong>.</p>
    <br>

    <p>{{$note_visitor ?? ''}}</p>
  
    @if ($status == 'Approved')
        <p>Your permit number is: <strong>{{ $permitNumber }}</strong></p>
    @endif

    <p>Thank you for your cooperation!</p>
</body>
</html>
