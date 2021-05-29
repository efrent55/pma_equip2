@extends('layouts.lte-main')

@section('title', 'Users')

@section('styles')
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li class="active">Users</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"><h4><i class="fa fa-list"></i> Users</h4></div>
                    <div class="col-sm-6"><a href="{{ route('users.create') }}" class="btn btn-flat btn-success pull-right">Add New User</a></div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm dt">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User Account</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><img class="img-circle " src="{{ asset('coreui/img/user-icon-png.png') }}" style="height:50px;" alt="{{ $user->username }}"></td>
                                <td><span class="text-blue"><b>{{ $user->username }}</b></span><br />
                                    <span class="text-muted">User Type: {{ $user->profiles->profile_type }}</span><br />
                                    <span class="badge @if($user->status==1) bg-green @else bg-red @endif">@if($user->status==1) Active @else Inactive @endif</span><br />
                                </td>
                                <td>{{ $user->profiles->lastname }}, {{ $user->profiles->firstname }}</td>
                                <td valign="right">
                                    <a href="#" data-toggle="modal" data-target="#modal-edit{{ $user->id }}" class="btn btn-default btn-md">EDIT</a>
                                    <a href="{{ route('password.reset', $user->id) }}" class="btn btn-default btn-md"><i class="fa fa-asterisk"></i> Password Reset</a>
                                    @if($user->status==1)
                                        <a href="{{ route('deactivate.user', $user->id) }}" class="btn btn-default btn-md text-red"><i class="fa fa-minus-circle"></i> Deactivate</a>
                                    @elseif($user->status==0)
                                        <a href="{{ route('activate.user', $user->id) }}" class="btn btn-default btn-md text-green"><i class="fa fa-check-circle"></i> Activate</a>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-edit{{ $user->id }}">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">Edit User : {{ $user->profiles->lastname }}, {{ $user->profiles->firstname }} {{ $user->profiles->middlename }}</h4>
                                    </div>
                                    <form role="form" method="post" action="{{ route('update.user', $user->id) }}">
                                        {{ csrf_field() }}
                                      <div class="modal-body">
                                            <p class="col-form-label"><b>Account Credentials</b></p>
                                            <div class="form-group col-md-12">
                                                <label for="type">Type <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="type" value="{{ $user->profiles->profile_type }}" readonly />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Serial Number <span style="color:red" title="Required Field for Cadets">*</span></label>
                                                <input class="form-control" type="text" id="sn" name="sn" value="{{ $user->profiles->sn }}" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Username <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}" required />
                                            </div>
                                            <hr />
                                            <p class="col-form-label"><b>Personal Information</b></p>
                                            <div class="form-group col-md-4">
                                                <label for="fname">First Name <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="fname" name="fname" value="{{ $user->profiles->firstname }}" required />
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="fname">Middle Name <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="mname" name="mname" value="{{ $user->profiles->middlename }}" required />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Surname <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="sname" name="sname" value="{{ $user->profiles->lastname }}" required />
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="fname">Suffix</label>
                                                <input class="form-control" type="text" id="ename" name="ename" value="{{ $user->profiles->extname }}" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Gender</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="Female" @if($user->profiles->gender=='Female') selected @endif>Female</option>
                                                    <option value="Male" @if($user->profiles->gender=='Male') selected @endif>Male</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Date of Birth</label>
                                                <input class="form-control" type="text" id="birthdate" name="birthdate" value="{{ $user->profiles->birthdate }}" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Company</label>
                                                <select class="form-control" id="coy" name="coy">
                                                    <option value="" @if($user->profiles->coy=='') selected @endif>N/A</option>
                                                    <option value="A" @if($user->profiles->coy=='A') selected @endif>A</option>
                                                    <option value="B" @if($user->profiles->coy=='B') selected @endif>B</option>
                                                    <option value="C" @if($user->profiles->coy=='C') selected @endif>C</option>
                                                    <option value="D" @if($user->profiles->coy=='D') selected @endif>D</option>
                                                    <option value="E" @if($user->profiles->coy=='E') selected @endif>E</option>
                                                    <option value="F" @if($user->profiles->coy=='F') selected @endif>F</option>
                                                    <option value="G" @if($user->profiles->coy=='G') selected @endif>G</option>
                                                    <option value="H" @if($user->profiles->coy=='H') selected @endif>H</option>
                                                </select>
                                            </div>
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