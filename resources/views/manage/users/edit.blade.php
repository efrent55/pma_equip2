@extends('layouts.core-main')

@section('title', 'Users')

@section('styles')
    <link href="{{ asset('coreui/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6><i class="fa fa-pencil"></i> Edit User</h6>
                <hr />
                <form class="form-horizontal" method="post" action="{{ route('users.update', $user->id) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><b>Personal Information</b></label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="fname">First Name <span style="color:red" title="Required Field">*</span></label>
                                    <input class="form-control" type="text" id="fname" name="fname" value="{{ $user->personnels->fname }}" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="fname">Middle Name <span style="color:red" title="Required Field">*</span></label>
                                    <input class="form-control" type="text" id="mname" name="mname" value="{{ $user->personnels->mname }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="sname">Surname <span style="color:red" title="Required Field">*</span></label>
                                    <input class="form-control" type="text" id="sname" name="sname" value="{{ $user->personnels->sname }}" />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="ename">Suffix</label>
                                    <input class="form-control" type="text" id="ename" name="ename" value="{{ $user->personnels->ename }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gender">Gender <span style="color:red" title="Required Field">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" disabled>Select</option>
                                        <option value="Female" {{ $user->personnels->gender=='Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Male" {{ $user->personnels->gender=='Male' ? 'selected' : '' }}>Male</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="type">Type <span style="color:red" title="Required Field">*</span></label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="" disabled>Select</option>
                                        <option value="Officer" {{ $user->personnels->personnel_type=='Officer' ? 'selected' : '' }}>Military Officer</option>
                                        <option value="Enlisted" {{ $user->personnels->personnel_type=='Enlisted' ? 'selected' : '' }}>Enlisted Personnel</option>
                                        <option value="CivHR" {{ $user->personnels->personnel_type=='CivHR' ? 'selected' : '' }}>Civilian Human Resource</option>
                                        <option value="OJT" {{ $user->personnels->personnel_type=='OJT' ? 'selected' : '' }}>OJT</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" {{ $user->personnels->employment_status=='' ? 'selected' : '' }}></option>
                                        <option value="Regular" {{ $user->personnels->employment_status=='Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Job Order" {{ $user->personnels->employment_status=='Job Order' ? 'selected' : '' }}>Job Order</option>
                                        <option value="Contractual" {{ $user->personnels->employment_status=='Contractual' ? 'selected' : '' }}>Contractual</option>
                                        <option value="Part-Time" {{ $user->personnels->employment_status=='Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><b>Account Credentials</b></label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="username">Username <span style="color:red" title="Required Field">*</span></label>
                                <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span style="color:red" title="Required Field">*</span></label>
                                <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" />
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><b>Office Assignment</b></label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="username">Office <span style="color:red" title="Required Field">*</span></label>
                                <select class="form-control select2" id="offices[]" name="offices[]" multiple required>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}"
                                            @foreach($user->offices_present as $officeAssigned)
                                                {{ $officeAssigned->id == $office->id ? 'selected' : '' }}
                                            @endforeach>
                                            <span title="{{ $office->description }}">{{ $office->office }}</span>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('coreui/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap'
            });
        });
    </script>
@endsection