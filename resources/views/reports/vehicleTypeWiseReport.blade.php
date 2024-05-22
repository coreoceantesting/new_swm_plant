<x-admin.layout>
    <x-slot name="title">Vehicle Type Wise Report</x-slot>
    <x-slot name="heading">Vehicle Type Wise Report</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="vehicleType">Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vehicleType" id="vehicleType">
                                        <option value="">Select Vehicle Type</option>
                                        @foreach($vehicleTypeLists as $list)
                                            <option value="{{ $list }}" {{ $list == $request->vehicleType ? 'selected' : '' }}>{{ $list }}</option>
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
                                    <a style="margin-top: 37px;" href="{{route('vehicleTypeWiseReport')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SR.NO</th>
                                        <th>Vendor Name</th>
                                        <th>Vehicle Type</th>
                                        <th>Date & Time </th>
                                        <th>Vehicle Number</th>
                                        <th>Gross Weight</th>
                                        <th>Tare Weight</th>
                                        <th>Net Weight</th>
                                        <th>Images</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $index => $result)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $result->Party_Name }}</td>
                                            <td>{{ $result->Field1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($result->EntryDate)->format('d-m-Y h:i:s A') }}</td>
                                            <td>{{ $result->Vehicle_No }}</td>
                                            <td>{{ number_format($result->GrossWt / 1000, 2)}} T</td>
                                            <td>{{ number_format($result->TareWt / 1000, 2)}} T</td>
                                            <td>{{ number_format($result->NetWt / 1000, 2) }} T</td>
                                            <td>
                                                <button type="button" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $result->id }}" data-id="{{ $result->id }}">
                                                  View
                                                </button>

                                                <div class="modal fade" id="exampleModal{{ $result->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $result->id }}" aria-hidden="true">
                                                  <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel{{ $result->id }}">Images</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body" id="imageContainer{{ $result->id }}">
                                                        </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach

                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>{{ number_format($totalGrossWeight / 1000, 2) }} T</strong></td>
                                        <td><strong>{{ number_format($totalTareWeight / 1000, 2) }} T</strong></td>
                                        <td><strong>{{ number_format($totalNetWeight / 1000, 2) }} T</strong></td>
                                        <td></td>
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
    $(document).ready(function () {
        $('#buttons-datatables').on('click', '.open-modal', function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/getImages/' + id,
                type: 'GET',
                success: function (response) {
                    $('#imageContainer' + id).html(response);
                    $('#exampleModal' + id).modal('show'); // Adjusted modal ID here
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
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
