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
                <div class="panel-heading">Register Vaccination</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/AddVaccination') }}">
                        {{ csrf_field() }}
                        @if($message=Session::get('success'))
                <div class='alert alert-success'>
                <p>{{$message}}</p>
                </div>
                @endif
                        <div class="form-group{{ $errors->has('ChildName') ? ' has-error' : '' }}">
                            <label for="ChildName" class="col-md-4 control-label">Child Name</label>
                            <div class="col-md-6">
                                <select id="ChildName" class="form-control" name="ChildName">
                                @foreach($data as $Value)
                                <option value='{{ $Value->ChildId }}'>{{ $Value->ChildName }}</option>
                                @endforeach
                                </select>
                               
                                
                                @if ($errors->has('ChildName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ChildName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('VaccinationName') ? ' has-error' : '' }}">
                            <label for="VaccinationName" class="col-md-4 control-label">Vaccination Name</label>

                            <div class="col-md-6">
                                <input id="VaccinationName" type="text" class="form-control" name="VaccinationName" value="{{ old('VaccinationName') }}">

                                @if ($errors->has('VaccinationName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VaccinationName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('VaccinationDuedate') ? ' has-error' : '' }}">
                            <label for="VaccinationDuedate" class="col-md-4 control-label">Vaccination Due date</label>

                            <div class="col-md-6">
                                <input id="VaccinationDuedate" type="date" class="form-control" name="VaccinationDuedate" value="{{ old('VaccinationDuedate') }}">

                                @if ($errors->has('VaccinationDuedate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VaccinationDuedate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Upload Details
                                </button>
                                <input type="text" value="{{ Auth::user()->email }}"id="email" name="email" style="visibility:hidden">
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