<x-admin.layout>
    <x-slot name="title">Summary Report</x-slot>
    <x-slot name="heading">Summary Report</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
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
                                    <label class="col-form-label" for="locationName">Locations <span class="text-danger">*</span></label>
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
                                    <button type="submit" style="margin-top: 37px;" class="btn btn-primary" id="addSubmit">Submit</button>
                                    <a style="margin-top: 37px;" href="{{route('summaryReport')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Vendor Name</th>
                                        @if ($request->fromdate)
                                            <th>From Date</th>
                                        @endif
                                        @if ($request->todate)
                                            <th>To Date</th>
                                        @endif
                                        <th>Total Gross Weight</th>
                                        <th>Total Tare Weight</th>
                                        <th>Total Net Weight</th>
                                        <th>Total Vehicle Round</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $result->Party_Name }}</td>
                                            @if ($request->fromdate)
                                                <th>{{ $request->fromdate }}</th>
                                            @endif
                                            @if ($request->todate)
                                                <th>{{ $request->todate }}</th>
                                            @endif
                                            <td>{{ $result->total_gross_weight / 1000 }} / Tons</td>
                                            <td>{{ $result->total_tare_weight / 1000}} / Tons</td>
                                            <td>{{ $result->total_net_weight / 1000}} / Tons</td>
                                            <td>{{ $result->total_vehicle_round }}</td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-admin.layout>
