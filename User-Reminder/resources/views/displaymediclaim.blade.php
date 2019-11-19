@extends('layouts.NavigationOption')

@section('content')
@if (Auth::guest())
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <li><a href="{{ url('/home') }}">Home</a></li>
                    You are Not Authorized  please logged in!
                </div>
            </div> 
        </div>
    </div>
</div>
@else

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$head}}</div>
                <div class="panel-body">
                <div class="table-responsive"><table class="table" style="border-radius:8%;width:100%">
                    <tr>
                    <thead style="background-color:#f5f5f5;border-radius:8%;">
                    @foreach($heading as $value)
                    <th>{{$value}}</th>
                    @endforeach
                    <th>Documents</th>
                    <th>Options</th>
                    </thead>
                    </tr>
                    <tbody>
                    @if($flg=='Mediclaim')
                        @foreach($data as $mediclaim)
                            <tr> 
                            <td>{{$mediclaim->PolicyNumber}}</td>
                            <td>{{$mediclaim->MediclaimCompany}}</td>
                            <td>{{$mediclaim->DateOfPurchase}}</td>
                            <td>{{$mediclaim->ReminderFrequency}} days</td>
                            <td><a href="/document/mediclaim/{{$mediclaim->PolicyNumber}}.png"><img src="/document/mediclaim/{{$mediclaim->PolicyNumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/mediclaim/{{$mediclaim->PolicyNumber}}.jpg"><img src="/document/mediclaim/{{$mediclaim->PolicyNumber}}.jpg" height="30px" width="30px" alt=""></a></td>
                            <td><a href="deleteuser/{{$mediclaim->PolicyNumber.',mediclaim,user'}}">Delete</a><br><a href="../Mediclaim/{{$mediclaim->PolicyNumber.',mediclaim'}}">Edit</a></td>
                            </tr>
                        @endforeach
                    @endif
                    @if($flg=='lic')
                        @foreach($data as $lic)
                            <tr> 
                            <td>{{$lic->Policynumber}}</td>
                            <td>{{$lic->PolicyHolder}}</td>
                            <td>{{$lic->LicPlanName}}</td>
                            <td>{{$lic->DateOfPurchase}}</td>
                            <td>{{$lic->SumAssuredAmount}}</td>
                            <td>{{$lic->PremiumAmount}}</td>
                            <td>{{$lic->PremiumPayingTerm}}</td>
                            <td>{{$lic->ReminderFrequency}} days</td>
                            <td><a href="/document/Lic/{{$lic->Policynumber}}.png"><img src="/document/Lic/{{$lic->Policynumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/Lic/{{$lic->Policynumber}}.jpg"><img src="/document/Lic/{{$lic->Policynumber}}.jpg" height="30px" width="30px" alt=""></a></td>
                            <td><a href="deleteuser/{{$lic->Policynumber.',lic,user'}}">Delete</a><br><a href="../LIC/{{$lic->Policynumber.',lic'}}">Edit</a></td>
                            </tr>
                        @endforeach
                    @endif
                    @if($flg=='electronics')
                        @foreach($data as $values)
                            <tr> 
                            <td>{{$values->ItemName}}</td>
                            <td>{{$values->Itemnumber}}</td>
                            <td>{{$values->DateOfPurchase}}</td>
                            <td>@if($values->WarrantyPeriod > 10) <p>{{$values->WarrantyPeriod}} days @endif @if($values->WarrantyPeriod < 10)  {{$values->WarrantyPeriod}}</p>year @endif</td>
                            <td>{{$values->ReminderFrequency}} days</td>
                            <td><a href="/document/Electronics/bills/{{$values->Itemnumber}}.png"><img src="/document/Electronics/bills/{{$values->Itemnumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/Electronics/warrenty/{{$values->Itemnumber}}.png"><img src="/document/Electronics/warrenty/{{$values->Itemnumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/Electronics/bills/{{$values->Itemnumber}}.jpg"><img src="/document/Electronics/bills/{{$values->Itemnumber}}.jpg" height="30px" width="30px" alt=""></a><a href="/document/Electronics/warrenty/{{$values->Itemnumber}}.jpg"><img src="/document/Electronics/warrenty/{{$values->Itemnumber}}.jpg" height="30px" width="30px" alt=""></a></td>
                            <td><a href="deleteuser/{{$values->Itemnumber.',electronics,user'}}">Delete</a><br><a href="../Electronics/{{$values->Itemnumber.',electronics'}}">Edit</a></td>
                            </tr>
                        @endforeach
                    @endif
                    @if($flg=='vehicle')
                        @foreach($data as $Value)
                            <tr> 
                            <td>{{$Value->VehicleNumber}}</td>
                            <td>{{$Value->DateOfPurchase}}</td>
                            <td>{{$Value->Servicing1DueDate}}</td>
                            <td>{{$Value->Servicing2DueDate}}</td>
                            <td>{{$Value->Servicing3DueDate}}</td>
                            <td><a href="deleteuser/{{$Value->VehicleNumber.',vehicle,user'}}">Delete</a><br><a href="../VehicleServiceing/{{$Value->VehicleNumber.',vehicle'}}">Edit</a></td>
                            </tr>
                        @endforeach
                    @endif
                    @if($flg=='child')
                        @foreach($data as $Value)
                            <tr> 
                            <td>{{$Value->ChildName}}</td>
                            <td>{{$Value->DateOfBirth}}</td>
                            <td>{{$Value->VaccinationName}}</td>
                            <td>{{$Value->VaccinationDuedate}}</td>
                            <td><a href="deleteuser/{{$Value->VaccinationId.',child,user,'.$Value->ChildId}}">Delete</a><br><a href="../ChildrenVaccin/{{$Value->VaccinationId.',child'}}">Edit</a></td>
                            </tr>
                        @endforeach
                    @endif
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
