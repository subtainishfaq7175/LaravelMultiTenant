@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data->name  }}</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $data->name  }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Sub-Domain:</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $data->subdomain  }}</p>
                        </div>
                    </div>

                    <div class="panel-body">
                        <a href="/user/{{ $data->id  }}" class="btn btn-primary">New User</a>
                        <h2>Users</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->username }}</th>
                                    <th>
                                        @if($user->role == 1)
                                            <span class="label label-success">Admin</span>
                                        @elseif($user->role == 2)
                                            <span class="label label-warning">Manager</span>
                                        @else
                                            <span class="label label-danger">Operator</span>
                                        @endif

                                    </th>
                                    <th>
                                        @if($user->status == 1)
                                            <span class="label label-success">Active</span>
                                        @elseif($user->status == 2)
                                            <span class="label label-warning">Pending</span>
                                        @else
                                            <span class="label label-danger">Deactive</span>
                                        @endif
                                    </th>
                                    <th>Action</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
