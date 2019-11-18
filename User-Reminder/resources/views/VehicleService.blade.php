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
                <div class="panel-heading">{{$head}}<a href="../displayall/{{ Auth::user()->email.',vehicle' }}" class="btn float-right">View details</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/VehicleService') }}">
                        {{ csrf_field() }}
                    @if($message=Session::get('success'))
                    <div class='alert alert-success'>
                    <p>{{$message}}</p>
                    </div>
                @endif
                    @if($flg=='insert')
                        <div class="form-group{{ $errors->has('VehicleType') ? ' has-error' : '' }}">
                            <label for="VehicleType" class="col-md-4 control-label">Vehicle Type</label>

                            <div class="col-md-6">
                                <select id="VehicleType" class="form-control" name="VehicleType">
                                <option value=''></option>
                                <option value='2 wheeler'>2 Wheeler</option>
                                <option value='4 wheeler'>4 Wheeler</option>
                                </select>
                                
                                @if ($errors->has('VehicleType'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VehicleType') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('VehicleNumber') ? ' has-error' : '' }}">
                            <label for="VehicleNumber" class="col-md-4 control-label">Vehicle Number</label>

                            <div class="col-md-6">
                                <input id="VehicleNumber" type="text" class="form-control" name="VehicleNumber" value="{{ old('VehicleNumber') }}">

                                @if ($errors->has('VehicleNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VehicleNumber') }}</strong>
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

                        <div class="form-group{{ $errors->has('Servicing1DueDate') ? ' has-error' : '' }}">
                            <label for="Servicing1DueDate" class="col-md-4 control-label">Servicing 1 Due Date</label>

                            <div class="col-md-6">
                                <input id="Servicing1DueDate" type="date" class="form-control" name="Servicing1DueDate" value="{{ old('Servicing1DueDate') }}">

                                @if ($errors->has('Servicing1DueDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Servicing1DueDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Servicing2DueDate') ? ' has-error' : '' }}">
                            <label for="Servicing2DueDate" class="col-md-4 control-label">Servicing 2 Due Date</label>

                            <div class="col-md-6">
                                <input id="Servicing2DueDate" type="date" class="form-control" name="Servicing2DueDate" value="{{ old('Servicing2DueDate') }}">

                                @if ($errors->has('Servicing2DueDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Servicing2DueDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Servicing3DueDate') ? ' has-error' : '' }}">
                            <label for="Servicing3DueDate" class="col-md-4 control-label">Servicing 3 Due Date</label>

                            <div class="col-md-6">
                                <input id="Servicing3DueDate" type="date" class="form-control" name="Servicing3DueDate" value="{{ old('Servicing3DueDate') }}">

                                @if ($errors->has('Servicing3DueDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Servicing3DueDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PUCExpirydate') ? ' has-error' : '' }}">
                            <label for="PUCExpirydate" class="col-md-4 control-label">PUC Expiry date</label>

                            <div class="col-md-6">
                                <input id="PUCExpirydate" type="date" class="form-control" name="PUCExpirydate" value="{{ old('PUCExpirydate') }}">

                                @if ($errors->has('PUCExpirydate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PUCExpirydate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="text" value="insert" name="choice" style="visibility:hidden">
                    @endif

                    @if($flg=='update')
                    @foreach($data as $Value)
                    <div class="form-group{{ $errors->has('VehicleType') ? ' has-error' : '' }}">
                            <label for="VehicleType" class="col-md-4 control-label">Vehicle Type</label>

                            <div class="col-md-6">
                                <select id="VehicleType" class="form-control" name="VehicleType" >
                                <option value='{{$Value->VehicleType}}'>{{$Value->VehicleType}}</option>
                                <option value='2 wheeler'>2 Wheeler</option>
                                <option value='4 wheeler'>4 Wheeler</option>
                                </select>
                                
                                @if ($errors->has('VehicleType'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VehicleType') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('VehicleNumber') ? ' has-error' : '' }}">
                            <label for="VehicleNumber" class="col-md-4 control-label">Vehicle Number</label>

                            <div class="col-md-6">
                                <input id="VehicleNumber" type="text" class="form-control" name="VehicleNumber" value="{{$Value->VehicleNumber}}" readonly>

                                @if ($errors->has('VehicleNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VehicleNumber') }}</strong>
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

                        <div class="form-group{{ $errors->has('Servicing1DueDate') ? ' has-error' : '' }}">
                            <label for="Servicing1DueDate" class="col-md-4 control-label">Servicing 1 Due Date</label>

                            <div class="col-md-6">
                                <input id="Servicing1DueDate" type="date" class="form-control" name="Servicing1DueDate" value="{{ $Value->Servicing1DueDate}}">

                                @if ($errors->has('Servicing1DueDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Servicing1DueDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Servicing2DueDate') ? ' has-error' : '' }}">
                            <label for="Servicing2DueDate" class="col-md-4 control-label">Servicing 2 Due Date</label>

                            <div class="col-md-6">
                                <input id="Servicing2DueDate" type="date" class="form-control" name="Servicing2DueDate" value="{{ $Value->Servicing2DueDate}}">

                                @if ($errors->has('Servicing2DueDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Servicing2DueDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Servicing3DueDate') ? ' has-error' : '' }}">
                            <label for="Servicing3DueDate" class="col-md-4 control-label">Servicing 3 Due Date</label>

                            <div class="col-md-6">
                                <input id="Servicing3DueDate" type="date" class="form-control" name="Servicing3DueDate" value="{{ $Value->Servicing3DueDate }}">

                                @if ($errors->has('Servicing3DueDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Servicing3DueDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PUCExpirydate') ? ' has-error' : '' }}">
                            <label for="PUCExpirydate" class="col-md-4 control-label">PUC Expiry date</label>

                            <div class="col-md-6">
                                <input id="PUCExpirydate" type="date" class="form-control" name="PUCExpirydate" value="{{ $Value->PUCExpirydate }}">

                                @if ($errors->has('PUCExpirydate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PUCExpirydate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="text" value="update" name="choice" style="visibility:hidden">
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