@extends('layouts.lte-main')

@section('title', 'Dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Equipment IS</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box box-body">

                <!--equipment status-->
                <div class="row">
                    <span class="col-lg-12 h4"><center>Equipment Status</center></span>
                    <div class="col-lg-4">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3>{{ $count_serviceable }}</h3><p>Serviceable</p></div>
                            <div class="icon"><i class="fa fa-check-circle-o"></i></div>
                            <a href="{{ route('equipment.report.equipment') }}?report=Serviceable" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3>{{ $count_unserviceable }}</h3><p>Unserviceable</p></div>
                            <div class="icon"><i class="fa fa-times-circle-o"></i></div>
                            <a href="{{ route('equipment.report.equipment') }}?report=Unserviceable" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3>{{ $count_turnedintosao }}</h3><p>Turned In to SAO</p></div>
                            <div class="icon"><i class="fa fa-history"></i></div>
                            <a href="{{ route('equipment.report.equipment') }}?report=Turned In To SAO" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <hr />

                <!--inventory status-->
                <div class="row">
                    <span class="col-lg-12 h4"><center>Inventory Status</center></span>
                    <div class="col-lg-4">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3>{{ $count_instorage }}</h3><p>In Storage</p></div>
                            <div class="icon"><i class="fa fa-tasks"></i></div>
                            <a href="{{ route('equipment.report.inventory') }}?report=In Storage" class="small-box-footer">View Inventory <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3>{{ $count_issued }}</h3><p>Issued</p></div>
                            <div class="icon"><i class="fa fa-tags"></i></div>
                            <a href="{{ route('equipment.report.inventory') }}?report=Issued" class="small-box-footer">View Inventory <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3>{{ $count_lostdamage }}</h3><p>Lost/Damage</p></div>
                            <div class="icon"><i class="fa fa-wrench"></i></div>
                            <a href="{{ route('equipment.report.inventory') }}?report=Lost or Damage" class="small-box-footer">View Inventory <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!--quick scan -->
                {{-- <div class="row">
                    <span class="col-lg-12 h5"><b>Quick Scan</b></span>
                    <div class="col-lg-12">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3>0</h3><p>In Storage</p></div>
                            <div class="icon"><i class="fa fa-tasks"></i></div>
                            <a href="#" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div> --}}

            </div>
        </div>
    </div>
</div>
@endsection