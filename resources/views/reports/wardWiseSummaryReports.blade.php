<x-admin.layout>
    <x-slot name="title">Ward Wise Summary Report</x-slot>
    <x-slot name="heading">Ward Wise Summary Report</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="theme-form" action="{{ route('wardWisesummaryReport') }}" name="addForm" id="addForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="locationName">Location Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="locationName" id="locationName">
                                        <option value="">Select Location</option>
                                        @foreach($locationLists as $list)
                                            <option value="{{ $list }}" {{ $list == $request->locationName ? 'selected' : '' }}>{{ $list }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="fromdate">From Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="fromdate" name="fromdate" value="{{ $request->fromdate ?? '' }}" type="date">
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="todate">To Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="todate" name="todate" value="{{ $request->todate ?? '' }}" type="date">
                                </div>
                                <div class="col-sm-3">
                                    <div class="row" style="margin-top: 36px;">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="{{ route('wardWisesummaryReport') }}" class="btn btn-warning">Cancel</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" title="Download Report" class="btn btn-primary" id="pdfSubmit"><i class="ri-file-pdf-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Location Name</th>
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
                                    @foreach ($results as $result)
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-admin.layout>

<script>
    function validateForm() {
        const fromDate = document.getElementById('fromdate').value;
        const toDate = document.getElementById('todate').value;

        if (!fromDate || !toDate) {
            alert('Both From Date and To Date are required.');
            return false;
        }

        if (new Date(toDate) < new Date(fromDate)) {
            alert('To Date must be greater than or equal to From Date.');
            return false;
        }

        return true;
    }
</script>

<script>
    document.getElementById('pdfSubmit').addEventListener('click', function() {
        document.getElementById('addForm').action = "{{ route('wardWiseSummaryPDF') }}";
        document.getElementById('addForm').submit();
    });
</script>
