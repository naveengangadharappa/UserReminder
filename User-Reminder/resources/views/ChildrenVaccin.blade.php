@extends('layouts.NavigationOption')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Children’s Registration <a href="displayall/{{ Auth::user()->email.',child' }}">View details</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/ChildrenVaccin') }}">
                        {{ csrf_field() }}

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
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Upload Details
                                </button>
                                <a href="{{ url('/AddVaccination') }}" style="padding:1%;">Add Vaccination</a>
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