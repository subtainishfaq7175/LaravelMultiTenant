@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Company Information</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('updateCompany') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input name="id" id="id" type="hidden" value="{{ $data->id }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name  }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subdomain') ? ' has-error' : '' }}">
                            <label for="subdomain" class="col-md-4 control-label">Sub Domain</label>

                            <div class="col-md-6">
                                <input id="subdomain" type="text" class="form-control" name="subdomain" value="{{ $data->subdomain  }}" required>

                                @if ($errors->has('subdomain'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subdomain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                <select id="status" name="status">
                                    <option {!! (($data->status == 1) ? 'selected':'') !!} value="1">Active</option>
                                    <option {!! (($data->status == 2) ? 'selected':'') !!} value="2">Pending</option>
                                    <option {!! (($data->status == 3) ? 'selected':'') !!} value="3">Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
