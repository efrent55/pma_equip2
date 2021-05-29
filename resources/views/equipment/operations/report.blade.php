@extends('layouts.lte-main')

@section('title', 'Report')

@section('styles')
    <script src="{{ asset('js/instascan.min.js') }}"></script>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li><a href="{{ route('operations.index') }}">Equipment Operations</a></li>
        <li class="active">Report</li>
    </ol>
@endsection

@section('content')

<div class="box box-solid">
    <div class="box-body">
        <h4><i class="fa fa-pencil"></i> Report Equipment</h4>
        <hr />
        <div class="row">
            <form class="form-horizontal">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Cadet</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cadet" value="{{ $cadet_name }}" readonly />
                        </div>
                    </div>
                </div>
            </form>

                <div class="col-md-8">
                    <table class="table table-condensed table-bordered table-responsive-sm dt">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipments as $equipment)
                                <tr>
                                    <td title="Property Number: {{ $equipment->property_number }} ">{{ $equipment->serial_number }}</td>
                                    <td>{{ $equipment->description }} ({{ $equipment->commonname }})</td>
                                    <td>{{ $equipment->unit_measure }}</td>
                                    <td>{{ $equipment->unit_value }}</td>
                                    <td>{{ $equipment->status }}</td>
                                    <td>{{-- <input type="checkbox" name="equipment_id[]" value="{{ $equipment->id }}" /> --}}
                                        <a href="#modal-select-equipment{{ $equipment->id }}" data-toggle="modal" class="btn btn-primary btn-sm pull-right">Select Equipment</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-select-equipment{{ $equipment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Report Equipment</h4>
                                            </div>
                                            <form class="form-horizontal" action="{{ route('equipment.store.report', $cadet_id) }}" method="post">
                                            {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><b class="pull-right">Cadet</b></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="cadet" value="{{ $cadet_name }}" readonly />
                                                        </div>
                                                    </div>
                                                    <br /><br />
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><b class="pull-right">EAR</b></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="ear" value="{{ $ear }}" readonly />
                                                        </div>
                                                    </div>
                                                    <br /><br />
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><b class="pull-right">Equipment</b></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="equipment" value="{{ $equipment->serial_number }} - {{ $equipment->description }}" readonly />
                                                            <input type="hidden" name="equipment_id" value="{{ $equipment->id }}" />
                                                        </div>
                                                    </div>
                                                    <br /><br />
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><b class="pull-right">Purpose <i class="text-red" title="Required field">*</i></b></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" name="purpose" required>
                                                                <option value="" selected disabled>- Select -</option>
                                                                <option value="Damaged">Damaged</option>
                                                                <option value="Lost">Lost</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br /><br />
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><b class="pull-right">Remarks</b></label>
                                                        <div class="col-sm-8">
                                                            <textarea type="text" class="form-control" name="remarks"></textarea>
                                                        </div>
                                                    </div>
                                                    <br /><br /><br />
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><b class="pull-right">If Representative</b></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control select2" name="rep_cadet_id" style="width:100%;">
                                                                <option value="" selected disabled>- Search -</option>
                                                                @foreach($cadets as $cadet)
                                                                    <option value="{{ $cadet->id }}">{{ $cadet->lastname }}, {{ $cadet->firstname }} C-{{ $cadet->sn }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <br /><br />
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <hr />
            <span class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
            </span>
        </form> --}}
    </div><!-- row -->
</div>


<div class="modal fade" id="modal-search-equipment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Equipment</h4>
        </div>
        <div class="modal-body">
            <table class="table table-condensed table-bordered table-responsive-sm dt">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipments as $equipment)
                        <tr>
                            <td title="Property Number: {{ $equipment->property_number }} ">{{ $equipment->serial_number }}</td>
                            <td>{{ $equipment->description }} ({{ $equipment->commonname }})</td>
                            <td>{{ $equipment->unit_measure }}</td>
                            <td>{{ $equipment->unit_value }}</td>
                            <td>{{ $equipment->status }}</td>
                            <td>
                                <a href="{{ route('equipment.add.equipment', $equipment->id) }}" class="btn btn-primary btn-sm pull-right">Select Equipment</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-scan-qrcode">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Scan QR Code</h4>
        </div>
        <div class="modal-body">
            <center><video id="preview" style="width:500px;height:500px;"></video></center>
            <br /><hr />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add Equipment</button>
        </div>
      </div>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
function activateScanner() {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        window.location.href = content;
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
        scanner.start(cameras[0]);
        } else {
        console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });
}

</script>

  <!-- DataTables -->
  <script src="{{ asset('adminlte/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $('.select2').select2();
    $(function () {
      $('.dt').DataTable()
    });

    $(".remove").click(function (e) {
        e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure you want to remove this equipment?")) {
                $.ajax({
                url: '{{ route('equipment.remove.equipment') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  </script>

@endsection