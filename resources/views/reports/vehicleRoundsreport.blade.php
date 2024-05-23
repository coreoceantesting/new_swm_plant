<x-admin.layout>
    <x-slot name="title">Vehicle Rounds Details</x-slot>
    <x-slot name="heading">Vehicle Rounds Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="theme-form" action="{{ route('vehicleroundsreport') }}" name="addForm" id="addForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            <div class="row">
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
                                            <a href="{{ route('vehicleroundsreport') }}" class="btn btn-warning">Cancel</a>
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
                                        <th>Sr No</th>
                                        <th>Vehicle No</th>
                                        <th>Vehicle Rounds</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalRounds = 0 ;
                                    @endphp
                                    @foreach ($results as $index => $result)
                                    @php
                                        $totalRounds += $result->total_vehicle_round ;
                                    @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $result->Vehicle_No }}</td>
                                            <td>{{ $result->total_vehicle_round }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td></td>
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
        document.getElementById('addForm').action = "{{ route('vehicleRoundsPDF') }}";
        document.getElementById('addForm').submit();
    });
</script>
