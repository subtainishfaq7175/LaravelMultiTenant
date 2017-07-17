@extends('layouts.company')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>

                @if(\Auth::user())
                <a href="{{ url('/logout') }}" class="btn btn-primary">Logout</a>
                @endif
            </div>
            <br/>
        </div>
    </div>
</div>
@endsection
