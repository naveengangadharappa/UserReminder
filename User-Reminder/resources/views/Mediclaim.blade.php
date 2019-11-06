@extends('layouts.NavigationOption')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medclaim Policy Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/Mediclaim') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('PolicyNumber') ? ' has-error' : '' }}">
                            <label for="PolicyNumber" class="col-md-4 control-label">Policy Number</label>

                            <div class="col-md-6">
                                <input id="PolicyNumber" type="text" class="form-control" name="PolicyNumber" value="{{ old('PolicyNumber') }}">
                                    
                                @if ($errors->has('PolicyNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PolicyNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('MediclaimCompany') ? ' has-error' : '' }}">
                            <label for="MediclaimCompany" class="col-md-4 control-label">Mediclaim Company</label>

                            <div class="col-md-6">
                                <input id="MediclaimCompany" type="text" class="form-control" name="MediclaimCompany" value="{{ old('MediclaimCompany') }}">

                                @if ($errors->has('MediclaimCompany'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('MediclaimCompany') }}</strong>
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


                        <div class="form-group{{ $errors->has('PremiumAmount') ? ' has-error' : '' }}">
                            <label for="PremiumAmount" class="col-md-4 control-label">Premium Amount</label>

                            <div class="col-md-6">
                                <input id="PremiumAmount" type="number" class="form-control" name="PremiumAmount" value="{{ old('Policynumber') }}">

                                @if ($errors->has('PremiumAmount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PremiumAmount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('ReminderFrequency') ? ' has-error' : '' }}">
                            <label for="ReminderFrequency" class="col-md-4 control-label">Reminder Frequency</label>

                            <div class="col-md-6">
                                <select id="ReminderFrequency" class="form-control" name="ReminderFrequency">
                                <option value=''></option>
                                <option value='30'>1 Month before Policy expire</option>
                                <option value='15'>15 days before Policy expire</option>
                                <option value='2'>2 days before Policy expire</option>
                                </select>
                                
                                @if ($errors->has('ReminderFrequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ReminderFrequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PolicyDocument') ? ' has-error' : '' }}">
                            <label for="PolicyDocument" class="col-md-4 control-label">Upload Policy Document</label>

                            <div class="col-md-6">
                                <input id="PolicyDocument" type="file" class="form-control" name="PolicyDocument">

                                @if ($errors->has('PolicyDocument'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PolicyDocument') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Upload Details
                                </button> <input type="text" value="{{ Auth::user()->email }}" name="email" style="visibility:hidden">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection