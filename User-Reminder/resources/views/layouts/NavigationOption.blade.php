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
                    <li><a href="{{ url('/Mediclaim/,0') }}">Mediclaim Policy</a></li>
                        <li><a href="{{ url('/LIC/,0') }}">LIC Polocies</a></li>
                        <li><a href="{{ url('/Electronics/,0') }}">Electronics Goods </a></li>
                        <li><a href="{{ url('/VehicleServiceing/,0') }}">Vehicle Servicing</a></li>
                        <li><a href="{{ url('/ChildrenVaccin ') }}">Children Vaccenation Reminder</a></li>
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
   <script>$(document).ready(function() {
    $('#PremiumPayingTerm').on('change',function()
    {
        console.log("change request entered");
        var ppt = $("#PremiumPayingTerm option:selected").html();
        $("#ReminderFrequency").find('option').remove();
        if(ppt==='Monthly')
        {
        $('#ReminderFrequency').append(new Option("15 days before Policy expire", "15"));
        $('#ReminderFrequency').append(new Option("7 days before Policy expire", "7"));
        $('#ReminderFrequency').append(new Option("1 day before Policy expire", "1"));
        }
        else if(ppt==='Quarterly')
        {
         $('#ReminderFrequency').append(new Option("1 Month before Policy expire", "30"));
        $('#ReminderFrequency').append(new Option("15 days before Policy expire", "15"));
        $('#ReminderFrequency').append(new Option("1 days before Policy expire", "1"));
        }
        else if(ppt=='Halfyear')
        {
         $('#ReminderFrequency').append(new Option("3 Month before Policy expire", "90"));
        $('#ReminderFrequency').append(new Option("1 month before Policy expire", "30"));
        $('#ReminderFrequency').append(new Option("15 days before Policy expire", "15"));
        $('#ReminderFrequency').append(new Option("1 days before Policy expire", "1"));
        }
        else
        {
        $('#ReminderFrequency').append(new Option("6 Month before Policy expire", "180"));
        $('#ReminderFrequency').append(new Option("3 Month before Policy expire", "90"));
        $('#ReminderFrequency').append(new Option("1 month before Policy expire", "30"));
        $('#ReminderFrequency').append(new Option("15 days before Policy expire", "15"));
        $('#ReminderFrequency').append(new Option("1 days before Policy expire", "1"));
        }   
    });

    $('#ChildName').on('click',function(event)
    {
        event.preventDefault();
        console.log("entered");
        $.ajax({
            url: "/getchild/{{ Auth::user()->email}}",
            method: "get",
           // data: "gnaveenkumar18.ng@gmail.com",
            success: function(response)
                {
                    var child = $("#ChildName").html();
                    $("#ChildName").find('option').remove();
                    var childnames=response.split(",");
                        i=0
                        while(i<childnames.length-1)
                        {
                        $('#ChildName').append(new Option(childnames[i], childnames[i+1]));
                        console.log(childnames[i]);
                        console.log(childnames[i+1]);
                        i=i+2;
                        }
                }
        })
        
    });
   });
    </script>

</body>
</html>
