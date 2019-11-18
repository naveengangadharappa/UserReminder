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
                <div class="panel-heading">{{$head}} <a href="../displayall/{{ Auth::user()->email.',electronics' }}" class="btn float-right">View details</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/Electronics') }}">
                        {{ csrf_field() }}
                        @if($message=Session::get('success'))
                <div class='alert alert-success'>
                <p>{{$message}}</p>
                </div>
                @endif
                        @if($flg=='insert')
                        <div class="form-group{{ $errors->has('ItemName') ? ' has-error' : '' }}">
                            <label for="ItemName" class="col-md-4 control-label">Item Name</label>

                            <div class="col-md-6">
                                <input id="ItemName" type="text" class="form-control" name="ItemName" value="{{ old('ItemName') }}">

                                @if ($errors->has('ItemName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ItemName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Itemnumber') ? ' has-error' : '' }}">
                            <label for="Itemnumber" class="col-md-4 control-label">Item Number</label>

                            <div class="col-md-6">
                                <input id="Itemnumber" type="text" class="form-control" name="Itemnumber" value="{{ old('Itemnumber') }}">

                                @if ($errors->has('Itemnumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Itemnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('DateOfPurchase') ? ' has-error' : '' }}">
                            <label for="DateOfPurchase" class="col-md-4 control-label">Date Of Purchase</label>

                            <div class="col-md-6">
                                <input id="DateOfPurchase" type="date" class="form-control" name="DateOfPurchase" value="{{ old('DateOfPurchase') }}">

                                @if ($errors->has('DateOfPurchase'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DateOfPurchase') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        
                        <div class="form-group{{ $errors->has('WarrantyPeriod') ? ' has-error' : '' }}">
                            <label for="WarrantyPeriod" class="col-md-4 control-label">Warranty Period</label>

                            <div class="col-md-6">
                                <select id="WarrantyPeriod" class="form-control" name="WarrantyPeriod">
                                <option value=''></option>
                                <option value='91'>3 Months</option>
                                <option value='182'>6 Months</option>
                                <option value='1'>1 Year</option>
                                <option value='2'>2 Year</option>
                                <option value='3'>3 Year</option>
                                <option value='5'>5 Year</option>
                                <option value='6'>6 Year</option>
                                <option value='8'>8 Year</option>
                                <option value='10'>10 Year</option>
                                </select>
                                
                                @if ($errors->has('WarrantyPeriod'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('WarrantyPeriod') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ReminderFrequency') ? ' has-error' : '' }}">
                            <label for="ReminderFrequency" class="col-md-4 control-label">Reminder Frequency</label>

                            <div class="col-md-6">
                                <select id="ReminderFrequency" class="form-control" name="ReminderFrequency">
                                <option value=''></option>
                                <option value='30'>1 Month before Warrenty expire</option>
                                <option value='15'>15 days before Warrenty expire</option>
                                <option value='2'>2 days before Warrenty expire</option>
                                </select>
                                
                                @if ($errors->has('ReminderFrequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ReminderFrequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('UploadBills') ? ' has-error' : '' }}">
                            <label for="UploadBills" class="col-md-4 control-label">Upload Invoice/Bills</label>

                            <div class="col-md-6">
                                <input id="UploadBills" type="file" class="form-control" name="UploadBills">
                                (.pdf ,  .jpg ,  .png) are accepted
                                @if ($errors->has('UploadBills'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('UploadBills') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('WarrantyCard') ? ' has-error' : '' }}">
                            <label for="WarrantyCard" class="col-md-4 control-label">Upload Warranty card</label>

                            <div class="col-md-6">
                                <input id="WarrantyCard" type="file" class="form-control" name="WarrantyCard">
                                (.pdf ,  .jpg ,  .png) are accepted
                                @if ($errors->has('WarrantyCard'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('WarrantyCard') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><input type="text" value="insert" name="choice" style="visibility:hidden">
                        @endif

                    @if($flg=='update')
                    @foreach($data as $Value)
                    <div class="form-group{{ $errors->has('ItemName') ? ' has-error' : '' }}">
                            <label for="ItemName" class="col-md-4 control-label">Item Name</label>

                            <div class="col-md-6">
                                <input id="ItemName" type="text" class="form-control" name="ItemName" value="{{ $Value->ItemName }}">

                                @if ($errors->has('ItemName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ItemName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Itemnumber') ? ' has-error' : '' }}">
                            <label for="Itemnumber" class="col-md-4 control-label">Item Number</label>

                            <div class="col-md-6">
                                <input id="Itemnumber" type="text" class="form-control" name="Itemnumber" value="{{ $Value->Itemnumber }}" readonly>

                                @if ($errors->has('Itemnumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Itemnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('DateOfPurchase') ? ' has-error' : '' }}">
                            <label for="DateOfPurchase" class="col-md-4 control-label">Date Of Purchase</label>

                            <div class="col-md-6">
                                <input id="DateOfPurchase" type="date" class="form-control" name="DateOfPurchase" value="{{ $Value->DateOfPurchase }}">

                                @if ($errors->has('DateOfPurchase'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DateOfPurchase') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        
                        <div class="form-group{{ $errors->has('WarrantyPeriod') ? ' has-error' : '' }}">
                            <label for="WarrantyPeriod" class="col-md-4 control-label">Warranty Period</label>

                            <div class="col-md-6">
                                <select id="WarrantyPeriod" class="form-control" name="WarrantyPeriod">
                                <option value='{{$Value->WarrantyPeriod}}'>@if($Value->WarrantyPeriod > 10) <p>{{$Value->WarrantyPeriod}}</p>  days @endif @if($Value->WarrantyPeriod < 10)  <p>{{$Value->WarrantyPeriod}}</p>  year @endif</option>
                                <option value='91'>3 Monthly</option>
                                <option value='182'>6 Monthly</option>
                                <option value='1'>1 Year</option>
                                <option value='2'>2 Year</option>
                                <option value='3'>3 Year</option>
                                <option value='5'>5 Year</option>
                                <option value='6'>6 Year</option>
                                <option value='8'>8 Year</option>
                                <option value='10'>10 Year</option>
                                </select>
                                
                                @if ($errors->has('WarrantyPeriod'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('WarrantyPeriod') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ReminderFrequency') ? ' has-error' : '' }}">
                            <label for="ReminderFrequency" class="col-md-4 control-label">Reminder Frequency</label>

                            <div class="col-md-6">
                                <select id="ReminderFrequency" class="form-control" name="ReminderFrequency">
                                <option value='{{$Value->ReminderFrequency}}'>{{ $Value->ReminderFrequency }} days</option>
                                <option value='30'>1 Month before Warrenty expire</option>
                                <option value='15'>15 days before Warrenty expire</option>
                                <option value='2'>2 days before Warrenty expire</option>
                                </select>
                                
                                @if ($errors->has('ReminderFrequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ReminderFrequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('UploadBills') ? ' has-error' : '' }}">
                            <label for="UploadBills" class="col-md-4 control-label">Upload Invoice/Bills</label>

                            <div class="col-md-6">
                                <input id="UploadBills" type="file" class="form-control" name="UploadBills">
                                (.pdf ,  .jpg ,  .png) are accepted
                                @if ($errors->has('UploadBills'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('UploadBills') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('WarrantyCard') ? ' has-error' : '' }}">
                            <label for="WarrantyCard" class="col-md-4 control-label">Upload Warranty card</label>

                            <div class="col-md-6">
                                <input id="WarrantyCard" type="file" class="form-control" name="WarrantyCard">
                                (.pdf ,  .jpg ,  .png) are accepted
                                @if ($errors->has('WarrantyCard'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('WarrantyCard') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><input type="text" value="update" name="choice" style="visibility:hidden">
                        @endforeach
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Upload Details
                                </button><input type="text" value="{{ Auth::user()->email }}" name="email" style="visibility:hidden">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection