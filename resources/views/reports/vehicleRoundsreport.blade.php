<x-admin.layout>
    <x-slot name="title">Vehicle Rounds Details</x-slot>
    <x-slot name="heading">Vehicle Rounds Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
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
                                    <button type="submit" style="margin-top: 37px;" class="btn btn-primary" id="addSubmit">Submit</button>
                                    <a style="margin-top: 37px;" href="{{route('vehicleroundsreport')}}" class="btn btn-warning">Cancel</a>
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
                                    @foreach ($results as $index => $result)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $result->Vehicle_No }}</td>
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
