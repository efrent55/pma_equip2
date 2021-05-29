@extends('layouts.lte-main')

@section('title', 'Users')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li class="active">Create User</li>
    </ol>
@endsection

@section('styles')

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6"><b><u>Create New User</u></b></div>
                    <div class="col-xs-6"><a href="{{ route('users.index') }}" class="btn btn-flat btn-sm btn-warning pull-right">Back</a></div>
                </div>
                <hr />
                <form role="form" method="post" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Account Credentials</b></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type">Type <span style="color:red" title="Required Field">*</span></label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="" selected disabled>Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="RSO">RSO</option>
                                            <option value="Cadet">Cadet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Serial Number <span style="color:red" title="Required Field for Cadets">*</span></label>
                                        <input class="form-control" type="text" id="sn" name="sn" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username <span style="color:red" title="Required Field">*</span></label>
                                        <input class="form-control" type="text" id="username" name="username" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Personal Information</b></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fname">First Name <span style="color:red" title="Required Field">*</span></label>
                                    <input class="form-control" type="text" id="fname" name="fname" required />
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="fname">Middle Name <span style="color:red" title="Required Field">*</span></label>
                                    <input class="form-control" type="text" id="mname" name="mname" required />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="sname">Surname <span style="color:red" title="Required Field">*</span></label>
                                    <input class="form-control" type="text" id="sname" name="sname" required />
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="ename">Suffix</label>
                                    <input class="form-control" type="text" id="ename" name="ename" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gender">Gender <span style="color:red" title="Required Field">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" class="form-control" name="birthdate" id="birthdate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fname">Company</label>
                                    <select class="form-control" id="coy" name="coy">
                                        <option value="">N/A</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-success">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script>
        $(function () {
            $('#datemask').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            $('[data-mask]').inputmask()
        })
</script>
@endsection