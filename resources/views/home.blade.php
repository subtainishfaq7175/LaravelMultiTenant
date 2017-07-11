@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <a href="{{ route('company') }}" class="btn btn-primary">New Company</a>
                        <h2>Companies</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Sub-Domain</th>
                                <th>Status</th>
                                <th>Users</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $company)
                                <tr>
                                    <td><a href="/companydetail/{{ $company->id  }}">{{ $company->name  }}</a></td>
                                    <td>{{ $company->subdomain  }}</td>
                                    <td>
                                        @if($company->status == 1)
                                            <span class="label label-success">Active</span>
                                        @elseif($company->status == 2)
                                            <span class="label label-warning">Pending</span>
                                        @else
                                            <span class="label label-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $company->usercount }}</td>
                                    <td><a href="/companyinfo/{{ $company->id  }}"  class="btn btn-warning">Edit</a> &nbsp; <button type="button" id="{{ $company->id  }}" class="btn btn-danger deleteCompany">Delete</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script>
        // A $( document ).ready() block.
        $( document ).ready(function() {
            // Event setup using a convenience method
            $(".deleteCompany").click(function() {
                var r = confirm("Are you Sure you want to delete this Company!");
                if (r == true) {
                    $.ajax({
                        url: "/companyDelete",
                        type: "POST",
                        data : {company_id : $(this).attr('id')}
                    }).done(function (responseData) {
                        window.location.reload();
                    });
                } else {
                    txt = "You pressed Cancel!";
                }
            });
        });

    </script>
@endsection
