<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
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

        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th,
        .content td {
            border: 1px solid black;
            padding: 10px;
        }
        .content th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td style="width: 10%;">
                <!-- Left Logo -->
                <img src="{{ public_path('admin/images/TMC-min.png') }}" alt="Left Logo" height="100">
            </td>
            <td style="width: 70%; text-align: center;">
                <!-- Company Name and Additional Info -->
                <h1 style="margin-bottom:-10px;"><strong>Thane Municipal Corporation</strong></h1>
                <h2 style="margin-bottom:-8px;"><strong>Diager Waste Handling</strong></h2>
                <h3><strong>{{ $title }}</strong></h3>
            </td>
            <td style="width: 20%;">
                <!-- Any content you want on the right side -->
                <img src="{{ public_path('admin/images/TMC-min.png') }}" alt="Left Logo" height="100">
            </td>
        </tr>
    </table>
    <hr>
    <div class="content">
        <table style="width: 100%;">
            <tr>
                <td style="padding:10px;border:none">
                    Search By
                </td>
                <td style="padding:10px;border:none">
                    Ward Name: {{ $locationName }}
                </td>
                <td style="padding:10px;border:none">
                    From Date: {{ $fromdate }}
                </td>
                <td style="padding:10px;border:none">
                    To Date: {{ $todate }}
                </td>
            </tr>
        </table>
        <br>
        <br>
        <table style="width:100%;border:1px solid black;">
            <thead>
                <tr>
                    <th>Ward Name</th>
                    <th>Total Gross Weight</th>
                    <th>Total Tare Weight</th>
                    <th>Total Net Weight</th>
                    <th>Total Vehicle Round</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGrossWeight = 0;
                    $totalTareWeight = 0;
                    $totalNetWeight = 0;
                    $totalRounds = 0 ;
                @endphp
                @foreach ($results as $index => $result)
                    @php
                        $totalGrossWeight += $result->total_gross_weight;
                        $totalTareWeight += $result->total_tare_weight;
                        $totalNetWeight += $result->total_net_weight;
                        $totalRounds += $result->total_vehicle_round;
                    @endphp
                    <tr>
                        <td>{{ $result->Field2 }}</td>
                        <td>{{ number_format($result->total_gross_weight / 1000, 2) }} T</td>
                        <td>{{ number_format($result->total_tare_weight / 1000, 2) }} T</td>
                        <td>{{ number_format($result->total_net_weight / 1000, 2) }} T</td>
                        <td>{{ $result->total_vehicle_round }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>{{ number_format($totalGrossWeight / 1000, 2) }} T</strong></td>
                    <td><strong>{{ number_format($totalTareWeight / 1000, 2) }} T</strong></td>
                    <td><strong>{{ number_format($totalNetWeight / 1000, 2) }} T</strong></td>
                    <td><strong>{{ $totalRounds }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
