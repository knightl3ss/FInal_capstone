<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            
            h1, h2 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            h2{
                letter-spacing: 10px;
            }
            h3 {
                margin-top: 0;
                text-align: left;
            }
            .border-black{
                border-bottom: 1px solid black;
                margin-bottom: 10px;
                margin-top: -15px;
                margin-left: 80px;
                width: 60%;
            }
            p::first-letter{
                margin-left: 20px;
            }
            .text-date{
                margin-left: 40px;
            }
            .row {
                display: flex;
                align-items: center; 
                justify-content:space-between; 
            }

            .paragraph {
                flex: 1;
                margin: 0;
            }
            .name{
                margin-left: 200px;
            }
            .position{
                margin-left: 200px;
                margin-top: -10px;
            }
            .position1{
                margin-left: 185px;
                margin-top: -10px;
            }
            .text{
                text-align: center;
            }
            .text-header{
                text-align: center;
                margin-top: -10px;
            }

            .action-buttons {
                display: flex;
                justify-content: flex-end;
                margin-bottom: 20px;
                gap: 15px;
            }
            
            .btn {
                padding: 8px 16px;
                font-size: 14px;
                border-radius: 4px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s;
                border: none;
                text-decoration: none;
            }
            
            .btn-print {
                background-color: #28a745;
                color: white;
            }
            
            .btn-print:hover {
                background-color: #218838;
            }
            
            .btn-return {
                background-color: #007bff;
                color: white;
            }
            
            .btn-return:hover {
                background-color: #0069d9;
            }
        
                .name-table {
                    border: none; 
                }
            
                .name-table th,
                .name-table td {
                    border: none; 
                }
            .name-table .border-bottom {
                border-bottom: 2px solid black; 
            }
            .name-table td {
                height: 10px; /* Set a specific height if needed */
            }
            .name-table th{
                width: 5%; /* Each cell will take up 25% of the table width */
                height: 20px; /* Set a specific height if needed */
            }
            .paragraph-1{
                text-align: left;
            }

            @media print {
                .no-print {
                    display: none;
                }
                body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            
            h1, h2 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            h2{
                letter-spacing: 10px;
            }
            h3 {
                margin-top: 0;
                text-align: left;
            }
            .border-black{
                border-bottom: 1px solid black;
                margin-bottom: 10px;
                margin-top: -15px;
                margin-left: 80px;
                width: 60%;
            }
            p::first-letter{
                margin-left: 20px;
            }
            .text-date{
                margin-left: 40px;
            }
            .row {
                display: flex;
                align-items: center; 
                justify-content:space-between; 
            }

            .paragraph {
                flex: 1;
                margin: 0;
            }
            .name{
                margin-left: 200px;
            }
            .position{
                margin-left: 200px;
                margin-top: -10px;
            }
            .position1{
                margin-left: 185px;
                margin-top: -10px;
            }
            .text{
                text-align: center;
            }
            .text-header{
                text-align: center;
                margin-top: -10px;
            }

            .action-buttons {
                display: none;
            }
        
                .name-table {
                    border: none; 
                }
            
                .name-table th,
                .name-table td {
                    border: none; 
                }
            .name-table .border-bottom {
                border-bottom: 2px solid black; 
            }
            .name-table td {
                height: 10px; /* Set a specific height if needed */
            }
            .name-table th{
                width: 5%; /* Each cell will take up 25% of the table width */
                height: 20px; /* Set a specific height if needed */
            }
            .paragraph-1{
                text-align: left;
            }

            }
       
    </style>
</head>

<div class="card-body p-0">
<div class="action-buttons no-print">
    <button class="btn btn-print" onclick="window.print()">Print this page</button>
    <button onclick="history.back()" class="btn btn-return">Return</button>
</div>
              <div class="table-responsive">
                    <div class="text-header">
                    <p>Republic of the Philippines</p>
                    <p>PROVINCE OF AGUSAN DEL NORTE</p>
                    <p class="fw-bold">Municipality of Magallanes</p>
                    </div>
                     <h2>SERVICE RECORD</h2>
                    <table class="name-table">
                        <tr>
                            <th>Name:</th> 
                            <td class="border-bottom"colspan="2" stat>JESSIE</td>
                            <td class="border-bottom"colspan="2" style="width: 22%;">M.</td>
                            <td class="border-bottom"colspan="2">RODAS</td>
                            <td class="paragraph-1" style="font-size: 16px;">(if married, give also a full maiden name)</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td colspan="2">Surname</td>
                            <td colspan="2">Given Name</td>
                            <td colspan="2">Middle Name</td>
                        </tr>
                        </table>

                        <table class="name-table">
                        <tr>
                            <th>Birth:</th> 
                            <td class="border-bottom" width="25%">May 28, 2001</td>
                            <td class="border-bottom" width="25%">RTR</td>
                            <td></td>
                            <td class="paragraph-1" colspan="2" style="font-size: 15px;">Data hermin should be checked from birth or
                            baptismal certificate or some other reliable documents.</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td style="width: 10%;">(Date)</td>
                            <td style="width: 10%;">(Place)</td>
                            <td></td>
                        </tr>
                    </table>
                    <p>This is to certify that above employee named herein- actually rendered service in the Office as
                        shown by the service record below, each line of which is supported by the appointment and other paper actually issued
                        by the Office and approved by the authorities concerned. </p>
                    <table class="table service-record-table">
                        <thead>
                            <tr>
                                <th colspan="2">Service</th>
                                <th colspan="3">Record of Appointment</th>
                                <th colspan="4">Office Entity/Leave Division Absence</th>
                                <th rowspan="2">Separation Date</th>
                                <th rowspan="2">Status</th>
                            </tr>
                            <tr>
                                <th colspan="2">Inclusive Dates</th>
                                <th>Designation</th>
                                <th>Status Salary</th>
                                <th>Salary Per Annum</th>
                                <th>Station Place</th>
                                <th colspan="2">Branch</th>
                                <th>Without Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>6/15/98</td>
                                <td>12/31/98</td>
                                <td>IT</td>
                                <td>Perm./Mo</td>
                                <td>100,000</td>
                                <td>RHU</td>
                                <td>Magallanes</td>
                                <td>Agusan del Norte</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <span class="status-badge in-service">
                                        In Service
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1/1/99</td>
                                <td>12/31/99</td>
                                <td>IT</td>
                                <td>Perm./Mo</td>
                                <td>122,000</td>
                                <td>RHU</td>
                                <td>Magallanes</td>
                                <td>Agusan del Norte</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <span class="status-badge suspension">
                                        Suspension
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1/1/00</td>
                                <td>8/31/00</td>
                                <td>IT</td>
                                <td>Perm./Mo</td>
                                <td>150,000</td>
                                <td>RHU</td>
                                <td>Magallanes</td>
                                <td>Agusan del Norte</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <span class="status-badge not-in-service">
                                        Not in Service
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="11" class="text">*** Nothing follow ***</th>
                        </tr>
                        </tbody>
                    </table>
                    <p>Issued in compliance with Executive No. 54, dated August 10, 1954, and in accordance with Circular 
                        NO. 58, dated August 10, 1954 of the system.
                    </p>
                    <h5 class="text-date">May 4, 2023</h5>
                    
                    <div class="row">
                        <div class="paragraph">
                    <p>Certified Correct:</p>
                    <h4 class="name">JESSIE M. RODAS</h4>
                    <p class="position1">MGADH-|(HRMO)</p>
                    </div>
                    <div class="paragraph">
                    <p>Noted:</p>
                    <h4 class="name">CESAR C. CUMBA JR.</h4>
                    <p class="position">Municipal Mayor</p>
                    </div>
                    </div>
            </div>
        </div>
    </div>  
   
</body>
</html>