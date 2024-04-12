<x-admin.layout>
    <x-slot name="title">Vendor Wise Collection</x-slot>
    <x-slot name="heading">Vendor Wise Collection</x-slot>
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
                                    <label class="col-form-label" for="fromdate">From Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="fromdate" name="fromdate" value="{{ $request->fromdate ?? '' }}" type="date">
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="todate">To Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="todate" name="todate" value="{{ $request->todate ?? '' }}" type="date">
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" style="margin-top: 37px;" class="btn btn-primary" id="addSubmit">Submit</button>
                                    <a style="margin-top: 37px;" href="{{route('vendorWiseReport')}}" class="btn btn-warning">Cancel</a>
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
                                        <th>Date & Time </th>
                                        <th>Vehicle No</th>
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
                                            <td>{{ $result->EntryDate }}</td>
                                            <td>{{ $result->Vehicle_No }}</td>
                                            <td>{{ $result->GrossWt }}/KG</td>
                                            <td>{{ $result->TareWt }}/KG</td>
                                            <td>{{ $result->NetWt }}/KG</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $index }}">
                                                    View
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $index }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel{{ $index }}">Images</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                                                <?php $imageData = $result->{"Img$i"}; ?>
                                                                <?php if ($imageData): ?>
                                                                    <img src="<?php echo 'data:image/png;base64,' . $imageData; ?>" height="200" width="200" alt="Image <?php echo $i; ?>">
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-admin.layout>