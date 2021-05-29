@extends('layouts.lte-main')

@section('title', 'Equipment Operations')

@section('styles')
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li class="active">Equipment Operations</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group" placeholder="Cadet">
                            <input type="text" class="form-control" placeholder="Select cadet..." value="{{ $cadet_name }}">
                            <span class="input-group-btn">
                                <a href="#" data-toggle="modal" data-target="#modal-select-cadet" class="btn btn-info">...</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        @include('_includes.alert.flash')
                    </div>
                </div>

                    <!-- modal -->
                    <div class="modal fade" id="modal-select-cadet">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Cadets</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-condensed table-bordered table-responsive-sm dt">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Coy</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cadets as $cadet)
                                            <tr>
                                                <td>{{ $cadet->sn }}</td>
                                                <td>{{ $cadet->lastname }}, {{ $cadet->firstname }} {{ $cadet->middlename }}</td>
                                                <td></td>
                                                <td><a href="{{ route('equipment.load.index', $cadet->id) }}" class="btn btn-default btn-sm pull-right">Select</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- modal -->


                <hr />
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <b>Issued</b> <a class="pull-right">{{ $count_issuance }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Turn In</b> <a class="pull-right">{{ $count_turnin }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Reported</b> <a class="pull-right">{{ $count_reported }}</a>
                            </li>
                          </ul>

                        <center>
                            <a href="{{ route('equipment.load.issuance', $cadet_id) }}" class="btn btn-primary" @if($cadet_id=='') disabled @endif>New Issuance</a>
                            <a href="{{ route('equipment.load.turnin', $cadet_id) }}" class="btn btn-success" @if($cadet_id=='') disabled @endif>New Turn-In</a>
                            <a href="{{ route('equipment.load.report', $cadet_id) }}" class="btn btn-danger" @if($cadet_id=='') disabled @endif>New Report</a>
                        </center>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-condensed table-bordered table-responsive-sm dt">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Serial Number</th>
                                    <th>Description</th>
                                    <th>EAR</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($items ==! '')
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>{{ $item->serial_number }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->ear }}</td>
                                            <td>{{ $item->type }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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
    $("#success-alert").hide();
    $(function () {
      $('.dt').DataTable()
    })
  </script>
@endsection