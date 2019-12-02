@extends('layouts.app')

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
                <div class="panel-heading">Edit Profile Details</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/UpdateProfile') }}">
                        {{ csrf_field() }}
                        @foreach($data as $Value)
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $Value->name }}" }}>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $Value->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Mobilenumber') ? ' has-error' : '' }}">
                            <label for="Mobilenumber" class="col-md-4 control-label">Mobile No</label>

                            <div class="col-md-6">
                                <input id="Mobilenumber" type="number" class="form-control" name="Mobilenumber" value="{{ $Value->Mobilenumber }}">

                                @if ($errors->has('Mobilenumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Mobilenumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Upload Details
                                </button>
                                <input type="text" value="{{ Auth::user()->email }}" name="uemail" style="visibility:hidden">
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