@extends('layouts.company')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Welcome
                    @if(\Auth::user())
                        <div class="pull-right">
                            <a href="{{ url('/logout') }}" class="">Logout</a>
                        </div>
                    @endif

                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Your Application's Landing Page.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form class="form-horizontal" role="form" name="logForm" id="logForm" action="/saveLog" method="post">
                                <div class="form-group">
                                    <label for="log" class="col-md-4 control-label">Enter Today's Log</label>
                                    <div class="col-md-6">
                                        <input id="log" type="text" class="form-control" name="log" value="{{ old('log') }}">
                                        {{ csrf_field() }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Log</th>
                                    <th>User</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ str_limit($log->log, 10) }}</td>
                                        <td>{{ $log->users->username }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>


            </div>
            <br/>
        </div>
    </div>
</div>
@endsection
