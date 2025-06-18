<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DHI Permit System Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .email-content {
         
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .no-reply-banner {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 16px;
            margin: -30px -30px 20px -30px;
            border-radius: 8px 8px 0 0;
            font-size: 14px;
        }

        .greeting {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .intro {
            margin-bottom: 20px;
            font-size: 15px;
        }

        .detail-item {
            margin-bottom: 12px;
        }

        .detail-label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 2px;
        }

        .detail-value {
            color: #555;
            margin-left: 0;
        }

        .status-section {
            margin: 20px 0;
        }

        .status-label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 2px;
        }

        .status-value {
            font-weight: bold;
            color: #17a2b8;
            font-size: 16px;
        }

        .footer {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .email-content {
                padding: 20px;
            }

            .no-reply-banner {
                margin: -20px -20px 15px -20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-content">
        <div class="no-reply-banner">
            <strong>Do not reply:</strong> This is an automated message from the DHI Permit System.
        </div>

        <div class="greeting">Dear Team,</div>

        <div class="intro">A new Permit to Work (PTW) request has been submitted:</div>

        <div class="detail-item">
            <span class="detail-label">Submission Time:</span>
            <div class="detail-value">{{ $submissionTime }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Company Name:</span>
            <div class="detail-value">{{ $companyName }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Requestor:</span>
            <div class="detail-value">{{ $requestorName }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Contact:</span>
            <div class="detail-value">{{ $companyContact }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Permit Validity:</span>
            <div class="detail-value">{{ $permitValidityFrom }} to {{ $permitValidityTo }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Work Description:</span>
            <div class="detail-value">{{ $workDescription }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Location:</span>
            <div class="detail-value">{{ $location }}</div>
        </div>

        <div class="detail-item">
            <span class="detail-label">Vehicle:</span>
            <div class="detail-value">{{ $vehicle }}</div>
        </div>

        <div class="status-section">
            <span class="status-label">Status:</span>
            <div class="status-value">{{ $status }}</div>
        </div>

        <div class="footer">
            You will be notified once the permit is reviewed.
        </div>
    </div>
</body>
</html>
