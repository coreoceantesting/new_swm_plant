<x-admin.layout>
    <x-slot name="title">Vendor Wise Summary Report</x-slot>
    <x-slot name="heading">Vendor Wise Summary Report</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}
    <style>
            .dt-buttons {
                float: right!important;
            }
            .dt-button {
                background-color: #8c68cd!important;
                border-color: #8c68cd!important;
                color: white!important;
                margin-left: 10px;
            }
            .dataTables_length, .dataTables_filter {
            display: inline-block!important;
            margin-right: 20px!important;
        }
    </style>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="theme-form" action="{{ route('summaryReport') }}" name="addForm" id="addForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="vendorName">Vendor Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vendorName" id="vendorName">
                                        <option value="">Select Vendor</option>
                                        @foreach($vendorLists as $list)
                                            <option value="{{ $list }}" {{ $list == $request->vendorName ? 'selected' : '' }}>{{ $list }}</option>
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
                                            <a href="{{ route('summaryReport') }}" class="btn btn-warning">Cancel</a>
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
                            <table id="buttons-datatables-new" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Vendor Name</th>
                                        {{-- @if ($request->fromdate)
                                            <th>From Date</th>
                                        @endif
                                        @if ($request->todate)
                                            <th>To Date</th>
                                        @endif --}}
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
                                            <td>{{ $result->Party_Name }}</td>
                                            {{-- @if ($request->fromdate)
                                                <th>{{ $request->fromdate }}</th>
                                            @endif
                                            @if ($request->todate)
                                                <th>{{ $request->todate }}</th>
                                            @endif --}}
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
                    </div>
                </div>
            </div>
        </div>


</x-admin.layout>

<script>
    $(document).ready(function() {
        var isAdmin = {{ auth()->user()->roles->pluck('name')[0] == 'Admin' ? 'true' : 'false' }};

        var buttons = isAdmin ? ["excel"] : [];

        new DataTable("#buttons-datatables-new", {
            paging: true,
            dom: "<'row'<'col-sm-6'l><'col-sm-6 text-right'fB>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: buttons,
        });
    });
</script>

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
        document.getElementById('addForm').action = "{{ route('vendorWiseSummaryPDF') }}";
        document.getElementById('addForm').submit();
    });
</script>
