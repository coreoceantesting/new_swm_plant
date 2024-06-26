<x-admin.layout>
    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .blink {
            animation: blink 1s infinite;
        }
    </style>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard (डॅशबोर्ड) </x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    {{-- new dashboard --}}
    <div class="row">
        <div class="col-xl-8">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-animate" id="totalSlipsCardNew">
                            <div class="card-body" style="background-color: papayawhip">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-muted mb-0">
                                            <b>Todays's Net Collection</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ number_format($todayNetCollectionSum / 1000, 2) }}">{{ number_format($todayNetCollectionSum  / 1000, 2) }}</span> <small class="text-primary">Tons</small>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0"><i class="ri-arrow-up-line align-middle"></i>
                                                16.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="award" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!--end col-->
                    <div class="col-xl-4 col-md-4">
                        <!-- card -->
                        <div class="card card-animate" id="todaySlipsCardNew">
                            <div class="card-body" style="background-color: deepskyblue">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-muted mb-0">
                                            <b>Monthly Net Collection</b>
                                        </a>
                                        @php
                                            $formattedMonthlyNetCollectionSum = number_format($monthlyNetCollectionSum / 1000, 2);
                                            $unformattedMonthlyNetCollectionSum = $monthlyNetCollectionSum / 1000;
                                        @endphp
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ $unformattedMonthlyNetCollectionSum }}">{{ $formattedMonthlyNetCollectionSum}}</span> <small class="text-primary">Tons</small>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0"><i class="ri-arrow-up-line align-middle"></i>
                                                16.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="award" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                    <div class="col-xl-4 col-md-4">
                        <!-- card -->
                        <div class="card card-animate" id="monthlySlipsCardNew">
                            <div class="card-body" style="background-color: mistyrose">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-muted mb-0">
                                           <b> Yearly Net Collection</b>
                                        </a>
                                        @php
                                            $formattedYearlyNetCollectionSum = number_format($yearlyNetCollectionSum / 1000, 2);
                                            $unformattedYearlyNetCollectionSum = $yearlyNetCollectionSum / 1000;
                                        @endphp
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ $unformattedYearlyNetCollectionSum }}">{{ $formattedYearlyNetCollectionSum }}</span> <small class="text-primary">Tons</small>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                3.96 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="box" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                    <div class="col-xl-4 col-md-4">
                        <!-- card -->
                        <div class="card card-animate" id="yearlySlipsCardNew">
                            <div class="card-body" style="background-color: skyblue">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-muted mb-0">
                                            <b>Vendor Count</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ $vendorCount }}">{{ $vendorCount }}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                0.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="list" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                    <div class="col-xl-4 col-md-4">
                        {{-- card --}}
                        <div class="card card-animate" id="actiontakenSlipsNew" style="background-color: lemonchiffon">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-muted mb-0">
                                            <b>Vehicle Count</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ $vehicleCount }}">{{ $vehicleCount }}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="external-link" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!--end col-->
                    <div class="col-xl-4 col-md-4">
                        <!-- card -->
                        <div class="card card-animate" id="vardiahavalSlipsCardNew">
                            <div class="card-body" style="background-color: paleturquoise">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-muted mb-0">
                                            <b>Weigh Bridge Count</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="1">1</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="file-text" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                </div><!--end row-->
                {{-- Today's Total Collection --}}
                <div class="card border-primary card-height-100" style="display: block">
                    <div class="card-header bg-primary align-items-center d-flex">
                        <h4 class="card-title text-white mb-0 flex-grow-1">
                            Today's Collection Details
                        </h4>
                        <div>
                            <a href="#" class="btn btn-soft-secondary btn-sm d-none">
                                View All
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                        <div class="table-responsive">
                            <table id="stockDetailsNew" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Gross Weight</th>
                                        <th>Tare Weight</th>
                                        <th>Net Weight</th>
                                        <th>Vehicle Rounds</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>{{ $todayCollectionDetails->gross_weight ? number_format($todayCollectionDetails->gross_weight / 1000, 2) : 0 }} Tons</td>
                                            <td>{{ $todayCollectionDetails->tare_weight ? number_format($todayCollectionDetails->tare_weight / 1000, 2) : 0 }} Tons</td>
                                            <td>{{ $todayCollectionDetails->net_weight ? number_format($todayCollectionDetails->net_weight / 1000, 2) : 0 }} Tons</td>
                                            <td>{{ $todayCollectionDetails->rounds ? $todayCollectionDetails->rounds : 0 }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                {{-- summary report --}}
                <div class="card border-primary card-height-100" style="display: none">
                    <div class="card-header bg-primary align-items-center d-flex">
                        <h4 class="card-title text-white mb-0 flex-grow-1">
                            WardWise Summary Report
                        </h4>
                        <div>
                            <a href="#" class="btn btn-soft-secondary btn-sm d-none">
                                View All
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                        <div class="table-responsive">
                            <table id="stockDetailsNew" class="table table-bordered nowrap align-middle" style="width:100%">
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
                                    @foreach ($wardWiseSummaryReport as $result)
                                        <tr>
                                            <td>{{ $result->Field2 }}</td>
                                            <td>{{ $result->total_gross_weight  ? number_format($result->total_gross_weight / 1000, 2) : 0 }} / Tons</td>
                                            <td>{{ $result->total_tare_weight ? number_format($result->total_tare_weight / 1000, 2) : 0}} / Tons</td>
                                            <td>{{ $result->total_net_weight ? number_format($result->total_net_weight / 1000, 2) : 0}} / Tons</td>
                                            <td>{{ $result->total_vehicle_round ? $result->total_vehicle_round : 0}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
        </div><!--end col-->

        <div class="col-xl-4">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">Latest Vehicle Net Collection List</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('vendorWiseReport') }}" class="btn btn-soft-primary btn-sm">
                            View All
                        </a>
                    </div>
                </div><!-- end card header -->
                <!-- card body -->
                <div class="card-body">
                    @foreach($latestVehicle as $list)
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><strong>Vehicle Number: </strong> {{$list->Vehicle_No}}</p>
                                <p class="card-text"><strong>Net Collection: </strong> {{ number_format($list->NetWt / 1000, 2) }} Tons</p>
                                <p class="card-text"><strong>Date & Time: </strong> {{\Carbon\Carbon::parse($list->Net_Date)->format('d-m-Y h:i:s A')}}</p>
                                <p class="card-text"><strong>Vendor Name: </strong> {{$list->Party_Name}}</p>
                                <p class="card-text"><strong>Ward Name: </strong> {{$list->Field2}}</p>
                                <p class="card-text"><strong>Vehicle Type: </strong> {{$list->Field1}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- end card body -->
            </div> <!-- .card-->
        </div><!--end col-->

        <div class="col-xl-8 d-none">
            <div class="card border-primary card-height-100" style="display: block">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Today's Collection Details
                    </h4>
                    <div>
                        <a href="#" class="btn btn-soft-secondary btn-sm d-none">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table id="stockDetailsNew" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Gross Weight</th>
                                    <th>Tare Weight</th>
                                    <th>Net Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $todayCollectionDetails->gross_weight ?? 0 }}</td>
                                        <td>{{ $todayCollectionDetails->tare_weight ?? 0 }}</td>
                                        <td>{{ $todayCollectionDetails->net_weight ?? 0 }}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div><!--end col-->

        <div class="col-xl-12 d-none">
            @foreach($vendors as $vendor)
                <div class="card border-primary card-height-10">
                    <div class="card-header bg-primary align-items-center d-flex">
                        <h4 class="card-title text-center text-white mb-0 flex-grow-1">
                            {{ $vendor->Party_Name }} Collection Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($collectionDetails[$vendor->Party_Name] as $period => $details)
                                <div class="col-md-3" style="padding-left:0px;padding-right:0px;">
                                    <div class="card">
                                        <div class="card-header bg-primary align-items-center d-flex">
                                            <h4 class="card-title text-white mb-0 flex-grow-1 text-center">
                                                {{ $period }}
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Gross</th>
                                                        <th>Tare</th>
                                                        <th>Net</th>
                                                        <th>Round</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $details->gross_weight ? round($details->gross_weight / 1000, 2) : 0 }} Tons</td>
                                                        <td>{{ $details->tare_weight ? round($details->tare_weight / 1000, 2) : 0 }} Tons</td>
                                                        <td>{{ $details->net_weight ? round($details->net_weight / 1000, 2) : 0 }} Tons</td>
                                                        <td>{{$details->rounds ? $details->rounds : 0}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-xl-12">
            <div class="card border-primary card-height-100" style="display: block">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Ward Wise Collection Details
                    </h4>
                    <div>
                        <a href="#" class="btn btn-soft-secondary btn-sm d-none">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ward Name</th>
                                    <th colspan="4" style="background-color: burlywood">Today</th>
                                    <th colspan="4" style="background-color: lightgreen">Current Month</th>
                                    <th colspan="4" style="background-color: lightblue">Previous Month</th>
                                    <th colspan="4" style="background-color:lightgoldenrodyellow">Current Year</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th style="background-color: burlywood">Gross Weight (Tons)</th>
                                    <th style="background-color:burlywood">Tare Weight (Tons)</th>
                                    <th style="background-color: burlywood">Net Weight (Tons)</th>
                                    <th style="background-color: burlywood">Rounds</th>
                                    <th style="background-color:lightgreen">Gross Weight (Tons)</th>
                                    <th style="background-color: lightgreen">Tare Weight (Tons)</th>
                                    <th style="background-color: lightgreen">Net Weight (Tons)</th>
                                    <th style="background-color: lightgreen">Rounds</th>
                                    <th style="background-color:lightblue">Gross Weight (Tons)</th>
                                    <th style="background-color: lightblue">Tare Weight (Tons)</th>
                                    <th style="background-color: lightblue">Net Weight (Tons)</th>
                                    <th style="background-color: lightblue">Rounds</th>
                                    <th style="background-color:lightgoldenrodyellow">Gross Weight (Tons)</th>
                                    <th style="background-color:lightgoldenrodyellow">Tare Weight (Tons)</th>
                                    <th style="background-color:lightgoldenrodyellow">Net Weight (Tons)</th>
                                    <th style="background-color:lightgoldenrodyellow">Rounds</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $location)
                                    <tr>
                                        <td>{{ $location->Field2 }}</td>
                                        @foreach(['Today', 'Current Month', 'Previous Month', 'Current Year'] as $period)
                                            @php
                                                $details = $wardWiseCollectionDetails[$location->Field2][$period];
                                                $style = '';
                                                switch ($period) {
                                                    case 'Today':
                                                        $style = 'background-color: burlywood';
                                                        break;
                                                    case 'Current Month':
                                                        $style = 'background-color: lightgreen';
                                                        break;
                                                    case 'Previous Month':
                                                        $style = 'background-color: lightblue';
                                                        break;
                                                    case 'Current Year':
                                                        $style = 'background-color: lightgoldenrodyellow';
                                                        break;
                                                }
                                            @endphp
                                            <td style="{{ $style }}">{{ $details->gross_weight ? round($details->gross_weight / 1000, 2) : 0 }}</td>
                                            <td style="{{ $style }}">{{ $details->tare_weight ? round($details->tare_weight / 1000, 2) : 0 }}</td>
                                            <td style="{{ $style }}">{{ $details->net_weight ? round($details->net_weight / 1000, 2) : 0 }}</td>
                                            <td style="{{ $style }}">{{ $details->rounds ? $details->rounds : 0 }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card border-primary card-height-100" style="display: block">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Vendor Wise Collection Details
                    </h4>
                    <div>
                        <a href="#" class="btn btn-soft-secondary btn-sm d-none">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th colspan="4" style="background-color: burlywood">Today</th>
                                    <th colspan="4" style="background-color: lightgreen">Current Month</th>
                                    <th colspan="4" style="background-color: lightblue">Previous Month</th>
                                    <th colspan="4" style="background-color:lightgoldenrodyellow">Current Year</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th style="background-color: burlywood">Gross Weight (Tons)</th>
                                    <th style="background-color: burlywood">Tare Weight (Tons)</th>
                                    <th style="background-color: burlywood">Net Weight (Tons)</th>
                                    <th style="background-color: burlywood">Rounds</th>
                                    <th style="background-color: lightgreen">Gross Weight (Tons)</th>
                                    <th style="background-color: lightgreen">Tare Weight (Tons)</th>
                                    <th style="background-color: lightgreen">Net Weight (Tons)</th>
                                    <th style="background-color: lightgreen">Rounds</th>
                                    <th style="background-color: lightblue">Gross Weight (Tons)</th>
                                    <th style="background-color: lightblue">Tare Weight (Tons)</th>
                                    <th style="background-color: lightblue">Net Weight (Tons)</th>
                                    <th style="background-color: lightblue">Rounds</th>
                                    <th style="background-color:lightgoldenrodyellow">Gross Weight (Tons)</th>
                                    <th style="background-color:lightgoldenrodyellow">Tare Weight (Tons)</th>
                                    <th style="background-color:lightgoldenrodyellow">Net Weight (Tons)</th>
                                    <th style="background-color:lightgoldenrodyellow">Rounds</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->Party_Name }}</td>
                                        @foreach(['Today', 'Current Month', 'Previous Month', 'Current Year'] as $period)
                                            @php
                                                $details = $collectionDetails[$vendor->Party_Name][$period];
                                                $style = '';
                                                switch ($period) {
                                                    case 'Today':
                                                        $style = 'background-color: burlywood';
                                                        break;
                                                    case 'Current Month':
                                                        $style = 'background-color: lightgreen';
                                                        break;
                                                    case 'Previous Month':
                                                        $style = 'background-color: lightblue';
                                                        break;
                                                    case 'Current Year':
                                                        $style = 'background-color: lightgoldenrodyellow';
                                                        break;
                                                }
                                            @endphp
                                            <td style="{{ $style }}">{{ $details->gross_weight ? round($details->gross_weight / 1000, 2) : 0 }}</td>
                                            <td style="{{ $style }}">{{ $details->tare_weight ? round($details->tare_weight / 1000, 2) : 0 }}</td>
                                            <td style="{{ $style }}">{{ $details->net_weight ? round($details->net_weight / 1000, 2) : 0 }}</td>
                                            <td style="{{ $style }}">{{ $details->rounds ? $details->rounds : 0 }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Monthly VendorWise Collection
                    </h4>
                    <select id="month-dropdown">
                        <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Jan</option>
                        <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Feb</option>
                        <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Mar</option>
                        <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>Apr</option>
                        <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>May</option>
                        <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Jun</option>
                        <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Jul</option>
                        <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Aug</option>
                        <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>Sep</option>
                        <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Oct</option>
                        <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>Nov</option>
                        <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Dec</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <canvas id="monthly-collection-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Daily Net Collection
                    </h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <canvas id="daily-collection-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>






    </div><!--end row-->

    @push('scripts')
    {{-- <script>
        $(document).ready(function() {

            $('#todaySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('todays_list') }}";
            });

            $('#monthlySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('monthly_list') }}";
            });

            $('#yearlySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('yearly_list') }}";
            });

            $('#actiontakenSlipsNew').on('click', function() {
                window.location.href = "{{ route('action_taken_list') }}";
            });

            $('#vardiahavalSlipsCardNew').on('click', function() {
                window.location.href = "{{ route('vardi_ahaval_list') }}";
            });

            $('#totalSlipsCardNew').on('click', function() {
                window.location.href = "{{ route('slips_list') }}";
            });

            $('#todaysListNew,#stockDetailsNew,#vehicledetails').dataTable({searching: false, paging: false, info: false});

        });
    </script> --}}

    {{-- for pdf --}}
    {{-- <script>
        $(document).ready(function() {
            $("#butTons-datatables").on("click", ".download-pdf", function(e) {
                e.preventDefault();
                var pdfFileName = $(this).data("pdf-file-name");
                var pdfUrl = "{{ url('/slips/') }}/" + pdfFileName;

                // Open the PDF in a new tab/window
                window.open(pdfUrl, '_blank');
            });
        });
    </script> --}}


    {{-- blink date if documents expire within 10 days --}}
    {{-- <script>
        $(document).ready(function() {
            var currentDate = new Date();

            $('#vehicledetails tbody tr').each(function() {
                var pucEndDate = new Date($(this).find('td:nth-child(4)').text()); // Adjust the index based on your table structure

                // Calculate the difference in days
                var timeDiff = pucEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(4)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); // Add class for styling
                }
            });

            $('#butTons-datatables tbody tr').each(function() {
                var insuranceEndDate = new Date($(this).find('td:nth-child(5)').text()); // Adjust the index based on your table structure

                // Calculate the difference in days
                var timeDiff = insuranceEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(5)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); // Add class for styling
                }
            });

            $('#butTons-datatables tbody tr').each(function() {
                var fitnessEndDate = new Date($(this).find('td:nth-child(6)').text()); // Adjust the index based on your table structure

                // Calculate the difference in days
                var timeDiff = fitnessEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(6)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); // Add class for styling
                }
            });

        });
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch monthly collection data
            function fetchMonthlyCollectionData(month) {
                $.ajax({
                    url: '{{ route('montly.collection') }}',
                    type: 'GET',
                    data: { month: month },
                    success: function(response) {
                        updateChart(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Function to update the chart with data
            function updateChart(data) {
                var vendorNames = [];
                var totalWeights = [];
                data.forEach(function(item) {
                    vendorNames.push(item.Party_Name);
                    totalWeights.push(item.total_weight);
                });
                myChart.data.labels = vendorNames;
                myChart.data.datasets[0].data = totalWeights;
                myChart.update();
            }

            // Trigger the AJAX request for current month data on document ready
            var currentMonth = (new Date()).getMonth() + 1; // JavaScript months are 0-indexed
            fetchMonthlyCollectionData(currentMonth);

            // Event listener for month dropdown change
            $('#month-dropdown').change(function() {
                var selectedMonth = $(this).val();
                fetchMonthlyCollectionData(selectedMonth);
            });
        });

        // Chart initialization
        var ctx = document.getElementById('monthly-collection-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Monthly Collection',
                    data: [],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Weight (ton)'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Vendor Name'
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('daily.collection') }}',
                type: 'GET',
                success: function(response) {
                    updateChartNew(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        var ctx = document.getElementById('daily-collection-chart').getContext('2d');
        var myChartNew = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Weight (ton)'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }]
                }
            }
        });

        function updateChartNew(data) {
            var vendors = Object.keys(data);
            vendors.forEach(function(vendor) {
                var vendorData = data[vendor];
                var dates = [];
                var totalWeights = [];
                vendorData.forEach(function(item) {
                    dates.push(item.date);
                    totalWeights.push(item.total_weight);
                });
                myChartNew.data.labels = dates;
                myChartNew.data.datasets.push({
                    label: vendor,
                    data: totalWeights,
                    backgroundColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',0.2)',
                    borderColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',1)',
                    borderWidth: 1
                });
            });
            myChartNew.update();
        }
    </script>

    @endpush

</x-admin.layout>
