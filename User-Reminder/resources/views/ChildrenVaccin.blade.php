@extends('layouts.NavigationOption')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$head}} <a href="../displayall/{{ Auth::user()->email.',child' }}" class="btn float-right">View details</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/ChildrenVaccin') }}">
                        {{ csrf_field() }}
                        @if($flg=='insert')
                        <div class="form-group{{ $errors->has('ChildName') ? ' has-error' : '' }}">
                            <label for="ChildName" class="col-md-4 control-label">Child Name</label>

                            <div class="col-md-6">
                                <input id="ChildName" type="text" class="form-control" name="ChildName" value="{{ old('ChildName') }}">

                                @if ($errors->has('ChildName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ChildName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('DateOfBirth') ? ' has-error' : '' }}">
                            <label for="DateOfBirth" class="col-md-4 control-label">Date Of Birth</label>

                            <div class="col-md-6">
                                <input id="DateOfBirth" type="date" class="form-control" name="DateOfBirth" value="{{ old('DateOfBirth') }}">

                                @if ($errors->has('DateOfBirth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DateOfBirth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><input type="text" value="insert" name="choice" style="visibility:hidden">
                        @endif

                    @if($flg=='update')
                    @foreach($data as $Value)
                    <div class="form-group{{ $errors->has('ChildName') ? ' has-error' : '' }}">
                            <label for="ChildName" class="col-md-4 control-label">Child Name</label>

                            <div class="col-md-6">
                                <input id="ChildName" type="text" class="form-control" name="ChildName" value="{{ $Value->ChildName }}">

                                @if ($errors->has('ChildName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ChildName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('DateOfBirth') ? ' has-error' : '' }}">
                            <label for="DateOfBirth" class="col-md-4 control-label">Date Of Birth</label>

                            <div class="col-md-6">
                                <input id="DateOfBirth" type="date" class="form-control" name="DateOfBirth" value="{{ $Value->DateOfBirth }}">

                                @if ($errors->has('DateOfBirth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DateOfBirth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('VaccinationName') ? ' has-error' : '' }}">
                            <label for="VaccinationName" class="col-md-4 control-label">Vaccination Name</label>

                            <div class="col-md-6">
                                <input id="VaccinationName" type="text" class="form-control" name="VaccinationName" value="{{ $Value->VaccinationName }}">

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
                                <input id="VaccinationDuedate" type="date" class="form-control" name="VaccinationDuedate" value="{{ $Value->VaccinationDuedate }}">

                                @if ($errors->has('VaccinationDuedate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VaccinationDuedate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="text" value="{{ $Value->ChildId }}" name="ChildId" style="visibility:hidden">
                        <input type="text" value="{{ $Value->VaccinationId }}" name="VaccinId" style="visibility:hidden">
                        <input type="text" value="update" name="choice" style="visibility:hidden">
                        @endforeach
                        @endif
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Upload Details
                                </button>
                                <a href="../AddVaccination/{{Auth::user()->email}}" class="btn float-right">Add Vaccination</a>
                                <input type="text" value="{{ Auth::user()->email }}" name="email" style="visibility:hidden">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection