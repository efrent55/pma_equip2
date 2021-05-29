@extends('layouts.lte-main')

@section('title', 'Issuance')

@section('styles')
    <script src="{{ asset('js/instascan.min.js') }}"></script>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li><a href="{{ route('operations.index') }}">Equipment Operations</a></li>
        <li class="active">Issuance</li>
    </ol>
@endsection

@section('content')

<div class="box box-solid">
    <div class="box-body">
        <h4><i class="fa fa-pencil"></i> New Issuance</h4>
        <hr />
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" action="{{ route('equipment.store.issuance', $cadet_id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Cadet</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cadet" value="{{ $cadet_name }}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">EAR</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ear" value="{{ $ear }}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Purpose</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="purpose" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Remarks</b></label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">If Representative</b></label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="rep_cadet_id">
                                <option value="" selected disabled>- Search -</option>
                                @foreach($cadets as $cadet)
                                    <option value="{{ $cadet->id }}">{{ $cadet->lastname }}, {{ $cadet->firstname }} C-{{ $cadet->sn }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr />
                    <table class="table table-condensed table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Value</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $temp)
                                <tr>
                                    <td>{{ $temp['serial_number'] }}</td>
                                    <td>{{ $temp['description'] }}</td>
                                    <td>{{ $temp['unit_measure'] }}</td>
                                    <td>{{ $temp['unit_value'] }}</td>
                                    <td><button class="btn btn-danger btn-sm remove" data-id="{{ $id }}"><i class="fa fa-trash-o"></i> Remove</button></td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <hr />
                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary" @if(!session('cart')) disabled @endif><i class="fa fa-save"></i> Save Changes</button>
                    </span>
                </form>
            </div>

            <div class="col-md-4">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">QR SCAN <a href="" data-toggle="modal" data-target="#modal-search-equipment"><i class="fa fa-search" title="Search Equipment"></i></a></label>
                        <div class="col-sm-8">
                            <video id="preview" style="height:180px;"></video>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
                        <th>Search String</th>
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
                            <td>{{ $equipment->qr_code }}</td>
                            <td>{{ $equipment->status }}</td>
                            <td>
                                <a href="{{ route('equipment.add.equipment', $equipment->id) }}" class="btn btn-primary btn-sm pull-right">Add Equipment</a>
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

@endsection

@section('scripts')
<script type="text/javascript">
function activateScanner() {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        /* window.location.href = content; */
        var table = $('.dt').DataTable();
        table.search(content).draw();
        //$('.dt').search('50RSUoHk8v').draw();
        $('#modal-search-equipment').modal('show');
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
    activateScanner();
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