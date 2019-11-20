@extends('layouts.app')

@section('content')
@if (Auth::guest())
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Attempting UnAuthorised Login </div>
                <div class="panel-body">
                <div style="background-color:pink;">
                    You are not Authorized please login with your Credientials
                    <br><strong> Do Not Attempt Again !!!</strong>
                    </div>
                </div></div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$head}}<div class="nav navbar-nav navbar-right" ><form method="POST" action="{{ url('/getuserdata') }}">{{ csrf_field() }}<input type="text" name="search" id="search" ><input type="submit" value="Search"></form></div> </div>
                <div class="panel-body">
                @if($message=Session::get('success'))
                <div class='alert alert-success'>
                <p>{{$message}}</p>
                </div>
                @endif
                <div class="table-responsive"><table class="table" style="border-radius:8%;width:100%">
                    <tr>
                    <thead style="background-color:#f5f5f5;border-radius:8%;">
                    
                    <th>Sl.no</th>
                    <th>User-Name</th>
                    <th>User-Email</th>
                    <th>User-Mobile-No</th>
                    <th>Options</th>
                    </thead>
                    </tr>
                    <tbody>
                        @foreach($data as $values)
                            <tr> 
                            <td>{{$values->id}}</td>
                            <td>{{$values->name}}</td>
                            <td>{{$values->email}}</td>
                            <td>{{$values->Mobilenumber}}</td>
                            <td><a href="/displayall/deleteuser/{{$values->email.',user,admin'}}">Delete</a><br>@if($values->status=='active')<a href="/displayall/InactiveUser/{{$values->email}}">Inactive User</a>@else<a href="/displayall/ActiveUser/{{$values->email}}">Active User</a>@endif<br><a href="/ViewCustomer/{{$values->email}}">View Details</a></td>
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
   
@endif
@endsection

