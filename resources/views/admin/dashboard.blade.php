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
                                            <span class="counter-value text-primary" data-target="{{ $todayNetCollectionSum }}">{{ $todayNetCollectionSum }}</span>
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
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ $monthlyNetCollectionSum }}">{{ $monthlyNetCollectionSum }}</span>
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
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{ $yearlyNetCollectionSum }}">{{ $yearlyNetCollectionSum }}</span>
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

            </div>
        </div><!--end col-->

        <div class="col-xl-4">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">Latest Vehicle Net Collection List</h4>
                    <div class="flex-shrink-0">
                        <a href="#" class="btn btn-soft-primary btn-sm d-none">
                            View All
                        </a>
                    </div>
                </div><!-- end card header -->
                <!-- card body -->
                <div class="card-body">
                    @foreach($latestVehicle as $list)
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><strong>Vehicle No: </strong> {{$list->Vehicle_No}}</p>
                                <p class="card-text"><strong>Net Collection: </strong> {{$list->NetWt}}</p>
                                <p class="card-text"><strong>Date & Time: </strong> {{$list->Net_Date}}</p>
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

        <div class="col-xl-12">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-center text-white mb-0 flex-grow-1">
                        Amol Transport Collection Details
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3" style="padding-left:0px;padding-right:0px;">
                            <div class="card">
                                <div class="card-header bg-primary align-items-center d-flex">
                                    <h4 class="card-title text-white mb-0 flex-grow-1 text-center">
                                        Todays
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
                                                <td>{{round($todayCollectionDetailsVendorOne->gross_weight) ?? 0}}</td>
                                                <td>{{round($todayCollectionDetailsVendorOne->tare_weight) ?? 0}}</td>
                                                <td>{{round($todayCollectionDetailsVendorOne->net_weight) ?? 0}}</td>
                                                <td>{{$todayCollectionDetailsVendorOne->todays_round}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding-left:0px;padding-right:0px;">
                            <div class="card">
                                <div class="card-header bg-primary align-items-center d-flex">
                                    <h4 class="card-title text-center text-white mb-0 flex-grow-1">
                                        Current Month
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table">
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
                                                <td>{{round($currentMonthCollectionDetailsVendorOne->gross_weight) ?? 0}}</td>
                                                <td>{{round($currentMonthCollectionDetailsVendorOne->tare_weight) ?? 0}}</td>
                                                <td>{{round($currentMonthCollectionDetailsVendorOne->net_weight) ?? 0}}</td>
                                                <td>{{$currentMonthCollectionDetailsVendorOne->current_month_rounds}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding-left:0px;padding-right:0px;">
                            <div class="card">
                                <div class="card-header bg-primary align-items-center d-flex">
                                    <h4 class="card-title text-center text-white mb-0 flex-grow-1">
                                        Previous Month
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table">
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
                                                <td>{{round($previousMonthCollectionDetailsVendorOne->gross_weight) ?? 0}}</td>
                                                <td>{{round($previousMonthCollectionDetailsVendorOne->tare_weight) ?? 0}}</td>
                                                <td>{{round($previousMonthCollectionDetailsVendorOne->net_weight) ?? 0}}</td>
                                                <td>{{$previousMonthCollectionDetailsVendorOne->rounds}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding-left:0px;padding-right:0px;">
                            <div class="card">
                                <div class="card-header bg-primary align-items-center d-flex">
                                    <h4 class="card-title text-center text-white mb-0 flex-grow-1">
                                        Current Year
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table">
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
                                                <td>{{round($currentYearCollectionDetailsVendorOne->gross_weight) ?? 0}}</td>
                                                <td>{{round($currentYearCollectionDetailsVendorOne->tare_weight) ?? 0}}</td>
                                                <td>{{round($currentYearCollectionDetailsVendorOne->net_weight) ?? 0}}</td>
                                                <td>{{$currentYearCollectionDetailsVendorOne->current_year_rounds}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
            $("#buttons-datatables").on("click", ".download-pdf", function(e) {
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

            $('#buttons-datatables tbody tr').each(function() {
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

            $('#buttons-datatables tbody tr').each(function() {
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



    @endpush

</x-admin.layout>
