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
            font-size: 10px;
            line-height: 1.2;
            color: black;
            background: white;
        }
        
        .container {
            width: 100%;
            max-width: 8.27in;
            margin: 0 auto;
            padding: 10px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
          
            padding-bottom: 10px;
        }
        
        .logo-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-left .wave-icon {
            width: 40px;
            height: 30px;
            background: linear-gradient(45deg, #00a8cc, #0066cc);
            border-radius: 5px;
            position: relative;
        }
        
        .logo-left .wave-icon::before {
            content: "≋≋≋";
            position: absolute;
            color: white;
            font-size: 12px;
            left: 8px;
            top: 8px;
        }
        
        .logo-text {
            font-weight: bold;
            font-size: 12px;
        }
        
        .logo-right {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4CAF50, #2196F3, #FFC107);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 10px;
        }
        
        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .note-section {
            margin-bottom: 15px;
        }
        
        .note-section ul {
            margin-left: 15px;
            margin-bottom: 10px;
        }
        
        .note-section li {
            margin-bottom: 3px;
        }
        
        .red-text {
            color: red;
            font-weight: bold;
        }
        
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border: 2px solid black;
        }
        
        .form-table th,
        .form-table td {
            border: 1px solid black;
            padding: 3px 5px;
            text-align: left;
            vertical-align: top;
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
            font-size: 10px;
        }
        
        .checkbox-section {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 2px 0;
        }
        
        .checkbox {
            width: 12px;
            height: 12px;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
            line-height: 10px;
            font-size: 10px;
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
            margin-top: 10px;
        }
        
        .notes-section ol {
            margin-left: 20px;
        }
        
        .notes-section li {
            margin-bottom: 5px;
        }
        
        
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            
            .container {
                max-width: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-left">
                <!-- <div class="wave-icon"> -->
                    <img style="height: 50px;width: 100px;" src="img/digital-hyperspace-logo.png" alt="">
                <!-- </div> -->
                <!-- <div class="logo-text">Digital<br>Hyperspace</div> -->
            </div>
            <div class="logo-right">EZSVS</div>
        </div>
        
        <!-- Title -->
        <div class="title">Permit to Work</div>
        
        <!-- Main Form Table with Notes -->
        <table class="form-table">
            <tr>
                <td colspan="5" style="padding: 10px; font-size: 8px;">
                    • Permit application form may be obtained from Reception or Mail Room at level 1. <span class="red-text">(Valid for three day)</span><br>
                    • All PTW must be submitted 24 hours in advance to EZSVS reception.<br>
                    • All Safety measures and procedures must be incorporated at all times.<br>
                    <strong>Note: Other Permits</strong> – If the work involve the following, please apply a separate permit attached to this PTW.<br>
                    &nbsp;&nbsp;a) Hot Work Permit &nbsp;&nbsp;b) Confined Space Permit &nbsp;&nbsp;c) Electrical System Permit
                </td>
            </tr>
            <tr>
                <th>Validity Date</th>
                <td>From: 28 April 2025</td>
                <td>To: 28 April 2025</td>
                <td>Permit No.</td>
                <td>25-0838</td>
            </tr>
            <tr>
                <th>Validity Time</th>
                <td>From: 08:30</td>
                <td>To: 17:30</td>
                <td colspan="2"></td>
            </tr>
          
             <tr>
                <th colspan="5" >Part 1: Requested By</th>
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
                <th colspan="5">Part 2: Work Description <span style="color: red;">(Mandatory)</span> </th>
              
            </tr>
            <tr>
                <td colspan="5">Visual check inspection T&T</td>
            </tr>
            <tr>
                  <td colspan="6"> &nbsp;</td>
            </tr>
            <!-- Part 3: Worker's Particulars -->
       <tr>
     <tr>
                <th colspan="5">Part 3: Worker's Particulars <span style="color: red;">(Attach workers name list if required)</span></th>
            </tr>
            <tr>
                <th>Total No. of Workers at EZSVS site</th>
                <!-- <td colspan="3">5</td> -->
            </tr>
            <tr>
                <td  style="width: 25%;">Name</td>
                <td  style="width: 25%;">ID No./Permit No.<br>Birthdate</td>
                <td  style="width: 25%;">Name</td>
                <td  style="width: 25%;" colspan="2">ID No./Permit No.<br>Birthdate</td>
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
                <td colspan="">
                    <div class="checkbox-section">
                        <span class="checkbox"></span> No
                    </div>
                </td>
              
                <td colspan="">If YES, state cause</td>
                <td > </td>
            </tr>
            <tr>
                <td colspan="5">Method to contain dust / SD :</td>
             
            </tr>
            <tr>
                <td colspan="3">Any Fire Protection System affected? e.g. Smoke detector, Sprinkler system.</td>
                <td> <div class="checkbox-section">
                        <span class="checkbox"></span> Yes
                    </div></td>
                <td> <div class="checkbox-section">
                        <span class="checkbox">✓</span> No
                    </div></td>
                
            </tr>
            <tr>
                <td colspan="2">Isolation of : 
                
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
                <td colspan="2">
                     Date/Time : 25/04/2025
                </td>
            </tr>
           <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td colspan="2">4</td>
             
           
           </tr>
           <tr>
            <td >5</td>
            <td >6</td>
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
            <td >5</td>
            <td >6</td>
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