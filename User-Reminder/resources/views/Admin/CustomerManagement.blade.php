@extends('Admin.navigation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$head}}<div class="nav navbar-nav navbar-right" ><input type="text" name="search" id="search" ><button >search</button></div> </div>
                <div class="panel-body">
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
                            <td><a href="/displayall/deleteuser/{{$values->email.',user'}}">Delete</a><br><a href="../Mediclaim/{{$values->email.',mediclaim'}}">View Details</a></td>
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

