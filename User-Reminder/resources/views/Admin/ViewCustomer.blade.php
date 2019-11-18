@extends('Admin.navigation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User-Details<div class="nav navbar-nav navbar-right" >{{$Email}}</div> </div>
                <div class="panel-body">
                <div class="table-responsive"><table class="table" style="border-radius:8%;width:100%">
                    <tr>
                    <thead style="background-color:#f5f5f5;border-radius:8%;">
                    
                    <th>Sl.no</th>
                    <th>Category</th>
                    <th>No-Of-Reminders</th>
                    <th>Options</th>
                    </thead>
                    </tr>
                    <tbody>
                        @foreach($medicaldata as $values)
                           @if($values->numbers!=0) 
                           <tr> 
                            <td>1</td>
                            <td>MediClaim</td>
                            <td>{{$values->numbers}}</td>
                            <td><a href="../Reminderlist/{{ $Email.',mediclaim' }}">View Details</a></td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($electronicsdata as $values)
                        @if($values->numbers!=0)
                            <tr> 
                            <td>2</td>
                            <td>Electronics</td>
                            <td>{{$values->numbers}}</td>
                            <td><a href="../Reminderlist/{{ $Email.',electronics' }}">View Details</a></td>
                            </tr>
                        @endif
                        @endforeach
                        @foreach($licdata as $values)
                        @if($values->numbers!=0)
                            <tr> 
                            <td>3</td>
                            <td>LICS</td>
                            <td>{{$values->numbers}}</td>
                            <td><a href="../Reminderlist/{{ $Email.',lic' }}">View Details</a></td>
                            </tr>
                        @endif
                        @endforeach
                        @foreach($vehicledata as $values)
                        @if($values->numbers!=0)    
                            <tr> 
                            <td>4</td>
                            <td>Vehicle-Servicing</td>
                            <td>{{$values->numbers}}</td>
                            <td><a href="../Reminderlist/{{ $Email.',vehicle' }}">View Details</a></td>
                            </tr>
                        @endif
                        @endforeach
                        @foreach($vaccindata as $values)
                        @if($values->numbers!=0)
                            <tr> 
                            <td>5</td>
                            <td>Vaccination</td>
                            <td>{{$values->numbers}}</td>
                            <td><a href="../Reminderlist/{{ $Email.',child' }}">View Details</a></td>
                            </tr>
                        @endif
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

