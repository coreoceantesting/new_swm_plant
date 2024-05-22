<!DOCTYPE html>
<html>
<head>
    <title>Laravel PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            /* display: flex; */
            align-items: center;
            justify-content: space-between;
            margin-bottom: 50px;
        }
        .header img {
            max-width: 70px;
            left: 0;
        }
        .header h1 {
            text-align: center;
            margin: 0 auto; /* Center the heading horizontally */
        }
        .content {
            text-align: left;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td style="width: 10%;">
                <!-- Left Logo -->
                <img src="{{ public_path('admin/images/TMC.png') }}" alt="Left Logo" height="100">
            </td>
            <td style="width: 70%; text-align: center;">
                <!-- Company Name and Additional Info -->
                <h1><strong>Thane Municipal Corporation</strong></h1>
                <h2><strong>Diager Waste Handling</strong></h2>
                <h3><strong>VendorWise Collection Report</strong></h3>
            </td>
            <td style="width: 20%;">
                <!-- Any content you want on the right side -->
            </td>
        </tr>
    </table>
    <hr>
    <div class="content">
        <table style="width: 100%;">
            <tr>
                <td style="border:1px solid black;padding:3px">Vendor Name:- Vendor Name</td>
                <td style="border:1px solid black;padding:3px">Report Print:- {{ $date }}</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:3px">From Date: {{ $date }}</td>
                <td style="border:1px solid black;padding:3px">To Date: {{ $date }}</td>
            </tr>
        </table>
        <br>
        <br>
        <table style="width:100%;border:1px solid black;">
            <thead>
                <tr>
                    <th style="border:1px solid black;">Date & Time </th>
                    <th style="border:1px solid black;">Vehicle Number</th>
                    <th style="border:1px solid black;">Vehicle Type</th>
                    <th style="border:1px solid black;">Location</th>
                    <th style="border:1px solid black;">Product</th>
                    <th style="border:1px solid black;">Gross Weight</th>
                    <th style="border:1px solid black;">Tare Weight</th>
                    <th style="border:1px solid black;">Net Weight</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                    <td style="border:1px solid black;">NA</td>
                </tr>
                <tr>
                    <td style="border:1px solid black;"><strong>Total</strong></td>
                    <td style="border:1px solid black;"></td>
                    <td style="border:1px solid black;"></td>
                    <td style="border:1px solid black;"></td>
                    <td style="border:1px solid black;"></td>
                    <td style="border:1px solid black;"><strong>NA</strong></td>
                    <td style="border:1px solid black;"><strong>NA</strong></td>
                    <td style="border:1px solid black;"><strong>NA</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
