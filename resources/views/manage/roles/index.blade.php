@extends('layouts.core-main')

@section('title', 'Users')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item active">MANAGEMENT</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6><i class="fa fa-user-md"></i> Roles</h6>
                <hr />

            </div>
        </div>
    </div>
</div>
@endsection