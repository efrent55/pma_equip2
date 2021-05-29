@extends('layouts.lte-main')

@section('title', 'Equipment Management')

@section('styles')
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li class="active">Equipment Management</li>
    </ol>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6"><h4><i class="fa fa-list"></i> Equipment</h4></div>
                    <div class="col-md-6">
                      <span class="pull-right">
                        <a href="{{ route('equipment.load.classification') }}" class="btn btn-flat btn-md btn-default">Equipment Classification</a>
                        <a href="{{ route('management.create') }}" class="btn btn-flat btn-md btn-success">Add New Equipment</a>
                      </span>
                    </div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-md dt">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Description</th>
                            <th>Unit Value</th>
                            <th>Unit</th>
                            <th>Date Acquired</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipments as $equipment)
                            <tr>
                                <td>{{ $equipment->serial_number }}</td>
                                <td>{{ $equipment->description }}</td>
                                <td>{{ $equipment->unit_value }}</td>
                                <td>{{ $equipment->unit_measure }}</td>
                                <td>{{ $equipment->date_acquired }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modal-edit{{ $equipment->id }}" class="btn btn-default btn-md">EDIT</a>
                                    <a href="#" data-toggle="modal" data-target="#modal-qrcode{{ $equipment->qr_code }}" class="btn btn-info btn-md">VIEW QR CODE</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-qrcode{{ $equipment->qr_code }}">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">PREVIEW QR CODE</h4>
                                  </div>
                                  <div class="modal-body">
                                      <center>{!! QrCode::size(200)->generate($equipment->qr_code); !!}</center>
                                      <br />
                                      <p class="text-muted small text-center">{{ $equipment->description }}, {{ $equipment->serial_number }}</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <a href="{{ asset($equipment->qrcode_file) }}" download="{{ $equipment->description }} {{ $equipment->serial_number }}" class="btn btn-warning">Download QR Code</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade" id="modal-edit{{ $equipment->id }}">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Equipment : {{ $equipment->description }}</h4>
                                  </div>
                                  <form role="form" action="{{ route('equipment.update.equipment', $equipment->id) }}" method="post">
                                    <div class="modal-body">
                                      {{ csrf_field() }}
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Property Number <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="property_number" value={{ $equipment->property_number }} />
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Serial Number <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="serial_number" value={{ $equipment->serial_number }} />
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label class="control-label"><b class="pull-right">Description <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="description" value={{ $equipment->description }} />
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="control-label"><b class="pull-right">Unit Measure <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="unit_measure" value={{ $equipment->unit_measure }} />
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="control-label"><b class="pull-right">Unit Value </b></label>
                                        <input type="text" class="form-control" name="unit_value" value={{ $equipment->unit_value }} />
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="control-label"><b class="pull-right">Date Acquired</b></label>
                                        <input type="text" class="form-control" name="date_acquired" value={{ $equipment->date_acquired }} />
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Classification <i class="text-red" title="Required field">*</i></b></label>
                                        <select class="form-control select2" name="classification" required> {{--  --}}
                                          @foreach($keywords as $keyword)
                                              <option value="{{ $keyword->id }}" {{ $equipment->keyword_id == $keyword->id ? 'selected':'' }}>{{ $keyword->commonname }}</option>
                                          @endforeach
                                      </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Status <i class="text-red" title="Required field">*</i></b></label>
                                        <select class="form-control" name="status" required>
                                          <option value="SERVICEABLE" @if($equipment->status=='SERVICEABLE') selected @endif>SERVICEABLE</option>
                                          <option value="UNSERVICEABLE" @if($equipment->status=='UNSERVICEABLE') selected @endif>UNSERVICEABLE</option>
                                          <option value="TURNED IN TO SAO" @if($equipment->status=='TURNED IN TO SAO') selected @endif>TURNED IN TO SAO</option>
                                        </select>
                                      </div>
                                      <hr />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                                    </div>
                                </form>
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <td colspan=5>{{ $users->links() }}</td>   --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="box-footer">
              @include('_includes.alert.flash')
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="modal-upload">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dimdiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Upload File</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <p class="help-block mdall">Make sure the file follow this format <a href=""><i class="fa fa-file-o"></i></a></p>
                <input type="file" id="fileUpload">
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dimdiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div> --}}


@endsection

@section('scripts')
  <!-- DataTables -->
  <script src="{{ asset('adminlte/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(function () {
      $('.dt').DataTable();
     /*  $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      }) */
    })
  </script>
@endsection