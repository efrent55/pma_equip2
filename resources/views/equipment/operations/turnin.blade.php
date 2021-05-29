@extends('layouts.lte-main')

@section('title', 'Turn In')

@section('styles')
    <script src="{{ asset('js/instascan.min.js') }}"></script>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li><a href="{{ route('operations.index') }}">Equipment Operations</a></li>
        <li class="active">Turn In</li>
    </ol>
@endsection

@section('content')

<div class="box box-solid">
    <div class="box-body">
        <h4><i class="fa fa-pencil"></i> Turn In Equipment</h4>
        <hr />
        <div class="row">
            <form class="form-horizontal" action="{{ route('equipment.store.turnin', $cadet_id) }}" method="post">
            {{ csrf_field() }}
                <div class="col-md-4">
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
                </div>

                <div class="col-md-8">
                    <table class="table table-condensed table-bordered table-responsive-sm dt">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Turn In</th>
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
                                    <td><input type="checkbox" name="equipment_id[]" value="{{ $equipment->id }}" /></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr />
            @include('_includes.alert.flash')
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save Changes</button>
        </form>
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