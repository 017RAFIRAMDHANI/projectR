<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permit to Work</title>
    <style>
        @page {
            size: A4;
            margin: 0.5in;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.15;
            color: black;
            background: white;
            width: 100%;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 7.7in;
            margin: 0 auto;
            padding: 6px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            width: 100%;
        }

        .logo-left {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .logo-left img {
            height: 42px;
            width: 85px;
            object-fit: contain;
        }

        .logo-right {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #4CAF50, #2196F3, #FFC107);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 11px;
            flex-shrink: 0;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 7px;
            text-align: left;
        }

        .red-text {
            color: red;
            font-weight: bold;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            border: 2px solid black;
            table-layout: fixed;
        }

        .form-table th,
        .form-table td {
            border: 1px solid black;
            padding: 3px 5px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 11px;
        }

        .form-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .section-header {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: center;
        }

        .small-input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 11px;
        }

        .checkbox-section {
            display: flex;
            align-items: center;
            gap: 4px;
            margin: 1px 0;
            flex-wrap: wrap;
        }

        .checkbox {
            width: 11px;
            height: 11px;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
            line-height: 9px;
            font-size: 11px;
            flex-shrink: 0;
        }

        .checked {
            background-color: black;
            color: white;
        }

        .signature-box {
            height: 30px;
            border: 1px solid black;
            margin: 2px;
            position: relative;
        }

        .signature-text {
            position: absolute;
            bottom: 2px;
            left: 5px;
            font-style: italic;
            font-size: 12px;
        }

        .notes-section {
            margin-top: 6px;
            padding: 4px;
        }

        .notes-section ol {
            margin-left: 18px;
        }

        .notes-section li {
            margin-bottom: 3px;
            font-size: 11px;
        }

        /* Column width control */
        .col-25 { width: 25%; }
        .col-20 { width: 20%; }
        .col-15 { width: 15%; }
        .col-35 { width: 35%; }

        /* Email compatibility styles */
        @media screen and (max-width: 600px) {
            .container {
                max-width: 100%;
                padding: 5px;
            }

            .form-table {
                font-size: 11px;
            }

            .header {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .container {
                max-width: 100%;
                padding: 0;
            }

            .form-table {
                page-break-inside: avoid;
            }
        }

        /* Ensure no content overflow */
        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        .form-table tr:last-child td {
            border-bottom: 2px solid black;
        }

        .form-table td:last-child,
        .form-table th:last-child {
            border-right: 2px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
      <div class="header">
    <div class="logo-left">
        <img src="{{ public_path('gambar/digital-hyperspace-logo.png') }}" alt="Digital Hyperspace Logo" onerror="this.style.display='none'">
    </div>
    <div class="logo-right">EZSVS</div>
</div>


        <!-- Title -->
        <div class="title">Permit to Work</div>

        <!-- Main Form Table -->
        <table class="form-table">
            <tr>
                <td colspan="5" style="padding: 6px; font-size: 11px;">
                    • Permit application form may be obtained from Reception or Mail Room at level 1. <span class="red-text">(Valid for three day)</span><br>
                    • All PTW must be submitted 24 hours in advance to EZSVS reception.<br>
                    • All Safety measures and procedures must be incorporated at all times.<br>
                    <strong>Note: Other Permits</strong> – If the work involve the following, please apply a separate permit attached to this PTW.<br>
                    &nbsp;&nbsp;a) Hot Work Permit &nbsp;&nbsp;b) Confined Space Permit &nbsp;&nbsp;c) Electrical System Permit
                </td>
            </tr>
            <tr>
                <th class="col-20">Validity Date</th>
                <td class="col-25">From: 28 April 2025</td>
                <td class="col-25">To: 28 April 2025</td>
                <td class="col-15">Permit No.</td>
                <td class="col-15">25-0838</td>
            </tr>
            <tr>
                <th>Validity Time</th>
                <td>From: 08:30</td>
                <td>To: 17:30</td>
                <td colspan="2"></td>
            </tr>

            <tr>
                <th colspan="5">Part 1: Requested By</th>
            </tr>
            <tr>
                <td>Company Name</td>
                <td>ZTE T&T</td>
                <td>Signature</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>Requestor Name</td>
                <td>Asrar</td>
                <td>Company Contact</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>Location of Work</td>
                <td>DH - Charging</td>
                <td>Contact phone</td>
                <td colspan="2">+62 813-8234-4840</td>
            </tr>
            <tr>
                <td>Building / Level / Room</td>
                <td>DX Building / Level 1st, 2nd and 3rd</td>
                <td colspan="3"></td>
            </tr>

            <tr>
                <th colspan="5">Part 2: Work Description <span class="red-text">(Mandatory)</span></th>
            </tr>
            <tr>
                <td colspan="5">Visual check inspection T&T</td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>

            <!-- Part 3: Worker's Particulars -->
            <tr>
                <th colspan="5">Part 3: Worker's Particulars <span class="red-text">(Attach workers name list if required)</span></th>
            </tr>
            <tr>
                <th colspan="5">Total No. of Workers at EZSVS site: 1</th>
            </tr>
            <tr>
                <td class="col-25">Name</td>
                <td class="col-25">ID No./Permit No.<br>Birthdate</td>
                <td class="col-25">Name</td>
                <td colspan="2">ID No./Permit No.<br>Birthdate</td>
            </tr>
            <tr>
                <td>Basil Ramadhan</td>
                <td>1771040412000001</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
            </tr>

            <!-- Part 4: Dust Control -->
            <tr>
                <th colspan="5" style="border-top: 2px solid black;">Part 4: Dust Control / Fire Alarm Isolation</th>
            </tr>
            <tr>
                <td>Does work generate dust ?</td>
                <td>
                    <div class="checkbox-section">
                        <span class="checkbox">✓</span> Yes
                    </div>
                </td>
                <td>
                    <div class="checkbox-section">
                        <span class="checkbox"></span> No
                    </div>
                </td>
                <td>If YES, state cause</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">Method to contain dust / SD :</td>
            </tr>
            <tr>
                <td colspan="3">Any Fire Protection System affected? e.g. Smoke detector, Sprinkler system.</td>
                <td>
                    <div class="checkbox-section">
                        <span class="checkbox"></span> Yes
                    </div>
                </td>
                <td>
                    <div class="checkbox-section">
                        <span class="checkbox">✓</span> No
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Isolation of:
                    <div class="checkbox-section">
                        <span class="checkbox"></span> Fire Panel
                        <span class="checkbox"></span> Smoke Detector
                        <span class="checkbox"></span> Sprinkler
                        <span class="checkbox"></span> ASD6
                    </div>
                </td>
                <td>Signature :</td>
                <td colspan="2">Date/Time :</td>
            </tr>
            <tr>
                <td>Isolated by Name :</td>
                <td colspan="4"></td>
            </tr>

            <!-- Part 5: Approval -->
            <tr>
                <th colspan="5" style="border-top: 2px solid black;">Part 5: Approval - By Facility Manager</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>EDI AHMAD J</td>
                <td>Signature :</td>
                <td colspan="2">Date/Time : 25/04/2025</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td colspan="2">4</td>
            </tr>
            <tr>
                <td>5</td>
                <td>6</td>
                <td colspan="3">7</td>
            </tr>

            <!-- Part 6: Notification -->
            <tr>
                <th colspan="5" style="border-top: 2px solid black;">Part 6: Notification of Work Completion by Requestor / Initiator</th>
            </tr>
            <tr>
                <td colspan="5">I hereby declared that all work has been completed and all workers working under my supervision have been notified of the cancellation of this permit. All materials and tools have been accounted for and removed from site. All areas have been cleaned up.</td>
            </tr>
            <tr>
                <td>Name : Asrar</td>
                <td>Signature :</td>
                <td colspan="3">Date/Time : 25 April 2025</td>
            </tr>

            <!-- Part 7: FM Permit Closure -->
            <tr>
                <th colspan="5" style="border-top: 2px solid black;">Part 7: FM Permit Closure by Escort Personnel</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>Signature :</td>
                <td colspan="3">Date/Time :</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td colspan="2">4</td>
            </tr>
            <tr>
                <td>5</td>
                <td>6</td>
                <td colspan="3">7</td>
            </tr>

            <!-- Notes -->
            <tr>
                <td colspan="5">
                    <div class="notes-section">
                        <strong>Note:</strong>
                        <ol>
                            <li>Requestor or its contractor shall retain an approved copy of this PTW whilst work is on-going.</li>
                            <li>All works shall be in accordance with EZSVS Cable Management Procedure.</li>
                            <li>The applicants and all their worker have read and understood EZSVS Facility Rules & Regulation.</li>
                        </ol>
                        <strong>All appropriate signature must be obtained before work commences</strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
