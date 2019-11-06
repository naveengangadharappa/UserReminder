@extends('layouts.NavigationOption')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Children’s Vaccination </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/register') }}">
                        {{ csrf_field() }}

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
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection