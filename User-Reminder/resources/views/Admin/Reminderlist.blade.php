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
                <div class="panel-heading">{{$head}}<div class="nav navbar-nav navbar-right" >{{$email}}</div> </div>
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
                            <td><a href="/document/mediclaim/{{$mediclaim->PolicyNumber}}.png"><img src="/document/mediclaim/{{$mediclaim->PolicyNumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/mediclaim/{{$mediclaim->PolicyNumber}}.jpg"><img src="/document/mediclaim/{{$mediclaim->PolicyNumber}}.jpg" height="30px" width="30px" alt=""></a>@if (file_exists(public_path("document/mediclaim/".$mediclaim->PolicyNumber.".pdf")))<a href="/document/mediclaim/{{$mediclaim->PolicyNumber}}.pdf"><img src="/document/Pdf.jpg" height="30px" width="30px" alt=""></a>@endif</td>
                            <td><a href="/displayall/deleteuser/{{$mediclaim->PolicyNumber.',mediclaim,admin'}}">Delete</a></td>
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
                            <td><a href="/document/Lic/{{$lic->Policynumber}}.png"><img src="/document/Lic/{{$lic->Policynumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/Lic/{{$lic->Policynumber}}.jpg"><img src="/document/Lic/{{$lic->Policynumber}}.jpg" height="30px" width="30px" alt=""></a>@if (file_exists(public_path("document/Lic/".$lic->Policynumber.".pdf")))<a href="/document/Lic/{{$lic->Policynumber}}.pdf"><img src="/document/Pdf.jpg" height="30px" width="30px" alt=""></a>@endif</td>
                            <td><a href="../deleteuser/{{$lic->Policynumber.',lic,admin'}}">Delete</a></td>
                            </tr>
                        @endforeach
                    @endif
                    @if($flg=='electronics')
                        @foreach($data as $values)
                            <tr> 
                            <td>{{$values->ItemName}}</td>
                            <td>{{$values->Itemnumber}}</td>
                            <td>{{$values->DateOfPurchase}}</td>
                            <td>@if($values->WarrantyPeriod > 10) <p>{{$values->WarrantyPeriod}} days @endif @if($values->WarrantyPeriod < 10)  {{$values->WarrantyPeriod}} year</p> @endif</td>
                            <td>{{$values->ReminderFrequency}} days</td>
                            <td><a href="/document/Electronics/bills/{{$values->Itemnumber}}.png"><img src="/document/Electronics/bills/{{$values->Itemnumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/Electronics/warrenty/{{$values->Itemnumber}}.png"><img src="/document/Electronics/warrenty/{{$values->Itemnumber}}.png" height="30px" width="30px" alt=""></a><a href="/document/Electronics/bills/{{$values->Itemnumber}}.jpg"><img src="/document/Electronics/bills/{{$values->Itemnumber}}.jpg" height="30px" width="30px" alt=""></a><a href="/document/Electronics/warrenty/{{$values->Itemnumber}}.jpg"><img src="/document/Electronics/warrenty/{{$values->Itemnumber}}.jpg" height="30px" width="30px" alt=""></a>@if (file_exists(public_path("document/Electronics/warrenty/".$values->Itemnumber.".pdf")))<a href="/document/Electronics/warrenty/{{$values->Itemnumber}}.pdf"><img src="/document/Pdf.jpg" height="30px" width="30px" alt=""></a>@endif  
                            @if (file_exists(public_path("document/Electronics/bills/".$values->Itemnumber.".pdf")))<a href="/document/Electronics/bills/{{$values->Itemnumber}}.pdf"><img src="/document/Pdf.jpg" height="30px" width="30px" alt=""></a>@endif</td>
                            <td><a href="../deleteuser/{{$values->Itemnumber.',electronics,admin'}}">Delete</a></td>
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
                            <td>No Document Required</td>
                            <td><a href="../deleteuser/{{$Value->VehicleNumber.',vehicle,admin'}}">Delete</a></td>
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
                            <td>No Document Required</td>
                            <td><a href="../deleteuser/{{$Value->VaccinationId.',child,admin,'.$Value->ChildId}}">Delete</a></td>-->
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

