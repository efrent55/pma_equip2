@extends('layouts.lte-main')

@section('title', 'Equipment Status Report')

@section('styles')
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li class="active">Equipment Status Report</li>
    </ol>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6"><h4><i class="fa fa-file"></i> {{ $report }}</h4></div>
                    <div class="col-xs-6"><a href="" class="btn btn-primary pull-right">Print Report</a></div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm dt">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Description</th>
                            <th>Unit Value</th>
                            <th>Unit</th>
                            <th>Date Acquired</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipments as $equipment)
                            <tr>
                                <td>{{ $equipment->serial_number }}1</td>
                                <td>{{ $equipment->description }}</td>
                                <td>{{ $equipment->unit_value }}</td>
                                <td>{{ $equipment->unit_measure }}</td>
                                <td>{{ $equipment->date_acquired }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <td colspan=5>{{ $users->links() }}</td>   --}}
                        </tr>
                    </tfoot>
                </table>
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