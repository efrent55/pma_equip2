@extends('layouts.core-main')

@section('title', 'Users')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">{{ $user->username }}</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <center class="mt-3">
                    <img class="rounded-circle" src="{{ asset('coreui/img/user-icon-png.png') }}" width="150" />
                    <h5 class="card-title mt-2">{{ $user->personnels->fname }} {{ $user->personnels->mname}} {{ $user->personnels->sname }} {{ $user->personnels->ename }}</h5>
                    <span class="card-subtitle"><a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none;">Edit Profile</a></span>
                </center>
                <hr />
                <small class="text-muted">Username</small>
                <h6>{{ $user->username }}</h6>
                <small class="text-muted">Gender</small>
                <h6>{{ $user->personnels->gender }}</h6>
                <small class="text-muted">Personnel Type</small>
                <h6>{{ $user->personnels->personnel_type }}</h6>
                <small class="text-muted">Employment Status</small>
                <h6>{{ $user->personnels->employment_status }}</h6>
                <small class="text-muted">Email Address</small>
                <h6>{{ $user->email }}</h6>
                <small class="text-muted">Contact Number</small>
                <h6></h6>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                {{-- <div class="alert alert-success alert-dismissable fade show" role="role">
                    Super HOT!
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div> --}}
                <small class="text-muted">Office Presently Assigned</small>
                <h6>
                    {{ $user->offices->count() == 0 ? 'None' : '' }}
                    @foreach($user->offices_present as $office)
                        <a href="{{ route('office.show', $office->id) }}" style="text-decoration:none;">{{ $office->office }}</a>@if(!$loop->last), @endif
                    @endforeach
                </h6>
                <hr />
                <form action="{{route('users.update', $user->id)}}" method="POST">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <small class="text-muted">Roles</small>
                    <div style="height:150px; overflow-y: scroll">
                        @foreach ($roles as $role)
                            <div class="form-check checkbox">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }} />
                                <label class="form-check-label">{{ $role->display_name }} <small class="text-muted">({{ $role->description }})</small></label>
                            </div>
                        @endforeach
                    </div>
                    <hr />
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <small class="text-muted">Permissions</small>
                    <div style="height:140px; overflow-y: scroll">
                        @foreach ($roles as $role)
                            <div class="form-check checkbox">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }} />
                                <label class="form-check-label">{{ $role->display_name }} <small class="text-muted">({{ $role->description }})</small></label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-sm btn-success float-right mt-2">Save Changes</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @section('scripts')
  <script>

    var app = new Vue({
      el: '#app',
      data: {
        rolesSelected: {!! $user->roles->pluck('id')!!} //{!! $user->roles->pluck('id') !!}
      }
    });

  </script>
@endsection --}}