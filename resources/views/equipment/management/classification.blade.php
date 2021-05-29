@extends('layouts.lte-main')

@section('title', 'Equipment Management')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Equipment IS</a></li>
        <li><a href="{{ route('management.index') }}">Equipment Management</a></li>
        <li class="active">Equipment Classification</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"><h4><i class="fa fa-list"></i> Equipment Classification</h4></div>
                    <div class="col-sm-6"><a href="#" data-toggle="modal" data-target="#modal-classification" class="btn btn-flat btn-success pull-right">Add New Classification</a></div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Common Name</th>
                            <th>Account</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commonnames as $commonname)
                            <tr>
                                <td>{{ $commonname->commonname }}</td>
                                <td>{{ $commonname->code }} - {{ $commonname->description }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-edit{{ $commonname->id }}" class="btn btn-default pull-right">Edit</a></td>
                            </tr>

                            <div class="modal fade" id="modal-edit{{ $commonname->id }}">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" action="{{ route('equipment.update.classification', $commonname->id) }}" method="post">
                                    {{ csrf_field() }}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Edit Classification : {{ $commonname->commonname }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label"><b class="pull-right">Account <i class="text-red" title="Required field">*</i></b></label>
                                                    <select class="form-control select2" name="account" required>
                                                        @foreach($accounts as $account)
                                                            <option value="{{ $account->id }}" {{ $commonname->account_id == $account->id ? 'selected':'' }}>{{ $account->code }} - {{ $account->description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><b class="pull-right">Common Name <i class="text-red" title="Required field">*</i></b></label>
                                                    <input type="text" class="form-control" name="commonname" value="{{ $commonname->commonname }}" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
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

<div class="modal fade" id="modal-classification">
    <div class="modal-dialog">
        <form class="form-horizontal" action="{{ route('equipment.store.classification') }}" method="post">
        {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Equipment Classification</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><b class="pull-right">Account <i class="text-red" title="Required field">*</i></b></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="account" required>
                                <option value="" selected disabled>- Select -</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><b class="pull-right">Common Name <i class="text-red" title="Required field">*</i></b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="commonname" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection