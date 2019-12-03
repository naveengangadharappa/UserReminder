<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
            border-radius:2px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>
                
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                    @if ( Auth::user()->roles=='admin')
                    <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                        <li><a href="{{ url('/CustomerManagement/,0') }}">Customer Management</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} Admin <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                    @if ( Auth::user()->roles=='user')
                    <li><a href="{{ url('/Mediclaim/,0') }}">Add Reminder</a></li>

                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               @if(Auth::user()->Remindertype=="smsemail") Email & SMS @else {{ strtoupper(Auth::user()->Remindertype)}} @endif <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->Remindertype=="email")
                            <li><a href="/ChangeReminder/{{Auth::user()->email}},sms"><i class="fa fa-btn fa-sign-out"></i>SMS</a></li>
                            <li><a href="/ChangeReminder/{{Auth::user()->email}},smsemail"><i class="fa fa-btn fa-sign-out"></i>SMS & EMAIL</a></li>
                            @endif
                            @if(Auth::user()->Remindertype=="sms")
                            <li><a href="/ChangeReminder/{{Auth::user()->email}},email"><i class="fa fa-btn fa-sign-out"></i>EMAIL</a></li>
                            <li><a href="/ChangeReminder/{{Auth::user()->email}},smsemail"><i class="fa fa-btn fa-sign-out"></i>SMS & EMAIL</a></li>
                            @endif
                            @if(Auth::user()->Remindertype=="smsemail")
                            <li><a href="/ChangeReminder/{{Auth::user()->email}},email"><i class="fa fa-btn fa-sign-out"></i>EMAIL</a></li>
                            <li><a href="/ChangeReminder/{{Auth::user()->email}},sms"><i class="fa fa-btn fa-sign-out"></i>SMS</a></li>
                            @endif
                            </ul>
                        </li>


                    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="/document/prfl.jpg" style="border-radius:50%; width:16%;height:16%;"> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                <li><a href="/EditProfile/{{Auth::user()->email}}"><i class="fa fa-btn fa-sign-out"></i>Edit Profile</a></li>
                            </ul>
                        </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script>
    $(document).ready(function() {
    $("#choice").on('change',function() {
            console.log("entered");
            var choice = $("#choice option:selected").html();
    }); 
});
    </script>
</body>
</html>
