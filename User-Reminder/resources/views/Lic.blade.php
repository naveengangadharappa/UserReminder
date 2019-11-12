@extends('layouts.NavigationOption')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$head}}<a href="../displayall/{{ Auth::user()->email.',lic' }}" class="btn float-right">View details</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/LIC') }}">
                        {{ csrf_field() }}
                        @if($flg=='insert')
                        <div class="form-group{{ $errors->has('Policynumber') ? ' has-error' : '' }}">
                            <label for="Policynumber" class="col-md-4 control-label">Policy Number</label>

                            <div class="col-md-6">
                                <input id="Policynumber" type="text" class="form-control" name="Policynumber" value="{{ old('Policynumber') }}">

                                @if ($errors->has('Policynumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Policynumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PolicyHolder') ? ' has-error' : '' }}">
                            <label for="PolicyHolder" class="col-md-4 control-label">Policy Holder Name</label>

                            <div class="col-md-6">
                                <input id="PolicyHolder" type="text" class="form-control" name="PolicyHolder" value="{{ old('PolicyHolder') }}">

                                @if ($errors->has('PolicyHolder'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PolicyHolder') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('LicPlanName') ? ' has-error' : '' }}">
                            <label for="LicPlanName" class="col-md-4 control-label">LIC plan Name</label>

                            <div class="col-md-6">
                                <input id="LicPlanName" type="text" class="form-control" name="LicPlanName" value="{{ old('LicPlanName') }}">

                                @if ($errors->has('LicPlanName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('LicPlanName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('SumAssuredAmount') ? ' has-error' : '' }}">
                            <label for="SumAssuredAmount" class="col-md-4 control-label">Sum Assured (Amount)</label>

                            <div class="col-md-6">
                                <input id="SumAssuredAmount" type="number" class="form-control" name="SumAssuredAmount" value="{{ old('SumAssuredAmount') }}">

                                @if ($errors->has('SumAssuredAmount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('SumAssuredAmount') }}</strong>
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
                        
                        <div class="form-group{{ $errors->has('PremiumPayingTerm') ? ' has-error' : '' }}">
                            <label for="PremiumPayingTerm" class="col-md-4 control-label">Premium Paying Term</label>

                            <div class="col-md-6">
                                <select id="PremiumPayingTerm" class="form-control" name="PremiumPayingTerm">
                                <option value=''></option>
                                <option value='Monthly'>Monthly</option>
                                <option value='Quarterly'>Quarterly</option>
                                <option value='HalfYear'>Half Year</option>
                                <option value='Yearly'>Yearly</option>
                                </select>
                                
                                @if ($errors->has('PremiumPayingTerm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PremiumPayingTerm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ReminderFrequency') ? ' has-error' : '' }}">
                            <label for="ReminderFrequency" class="col-md-4 control-label">Reminder Frequency</label>

                            <div class="col-md-6">
                                <select id="ReminderFrequency" class="form-control" name="ReminderFrequency">
                                <option value=''></option>
                                <!--<option value='30'>1 Month before Policy expire</option>
                                <option value='15'>15 days before Policy expire</option>
                                <option value='2'>2 days before Policy expire</option>-->
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
                        <input type="text" value="insert" name="choice" style="visibility:hidden">
                    @endif

                    @if($flg=='update')
                    @foreach($data as $Value)
                    <div class="form-group{{ $errors->has('Policynumber') ? ' has-error' : '' }}">
                            <label for="Policynumber" class="col-md-4 control-label">Policy Number</label>

                            <div class="col-md-6">
                                <input id="Policynumber" type="text" class="form-control" name="Policynumber" value="{{ $Value->Policynumber }}">

                                @if ($errors->has('Policynumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Policynumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PolicyHolder') ? ' has-error' : '' }}">
                            <label for="PolicyHolder" class="col-md-4 control-label">Policy Holder Name</label>

                            <div class="col-md-6">
                                <input id="PolicyHolder" type="text" class="form-control" name="PolicyHolder" value="{{ $Value->PolicyHolder }}">

                                @if ($errors->has('PolicyHolder'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PolicyHolder') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('LicPlanName') ? ' has-error' : '' }}">
                            <label for="LicPlanName" class="col-md-4 control-label">LIC plan Name</label>

                            <div class="col-md-6">
                                <input id="LicPlanName" type="text" class="form-control" name="LicPlanName" value="{{ $Value->LicPlanName }}">

                                @if ($errors->has('LicPlanName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('LicPlanName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('SumAssuredAmount') ? ' has-error' : '' }}">
                            <label for="SumAssuredAmount" class="col-md-4 control-label">Sum Assured (Amount)</label>

                            <div class="col-md-6">
                                <input id="SumAssuredAmount" type="number" class="form-control" name="SumAssuredAmount" value="{{$Value->SumAssuredAmount  }}">

                                @if ($errors->has('SumAssuredAmount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('SumAssuredAmount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PremiumAmount') ? ' has-error' : '' }}">
                            <label for="PremiumAmount" class="col-md-4 control-label">Premium Amount</label>

                            <div class="col-md-6">
                                <input id="PremiumAmount" type="number" class="form-control" name="PremiumAmount" value="{{ $Value->PremiumAmount }}">

                                @if ($errors->has('PremiumAmount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PremiumAmount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('PremiumPayingTerm') ? ' has-error' : '' }}">
                            <label for="PremiumPayingTerm" class="col-md-4 control-label">Premium Paying Term</label>

                            <div class="col-md-6">
                                <select id="PremiumPayingTerm" class="form-control" name="PremiumPayingTerm">
                                <option value='{{ $Value->PremiumPayingTerm }}'>{{ $Value->PremiumPayingTerm }}</option>
                                <option value='Monthly'>Monthly</option>
                                <option value='Quarterly'>Quarterly</option>
                                <option value='HalfYear'>Half Year</option>
                                <option value='Yearly'>Yearly</option>
                                </select>
                                
                                @if ($errors->has('PremiumPayingTerm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PremiumPayingTerm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ReminderFrequency') ? ' has-error' : '' }}">
                            <label for="ReminderFrequency" class="col-md-4 control-label">Reminder Frequency</label>

                            <div class="col-md-6">
                                <select id="ReminderFrequency" class="form-control" name="ReminderFrequency">
                                <option value='{{ $Value->ReminderFrequency }}'>{{ $Value->ReminderFrequency }} days</option>
                                <!--<option value='30'>1 Month before Policy expire</option>
                                <option value='15'>15 days before Policy expire</option>
                                <option value='2'>2 days before Policy expire</option>-->
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

@endsection

<!--@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
 $(document).ready(function() {
    console.log("change request entered");
    $('#PremiumPayingTerm').on('change',function()
    {
        console.log("change request entered");
        //$('#ReminderFrequency').append('<option value='30'>1 Month before Policy expire</option>');
        $('#ReminderFrequency').append(new Option("15", "15 days before Policy expire"));
        $('#ReminderFrequency').append(new Option("2", "2 days before Policy expire"));

    });
   });
</script

@endsection-->