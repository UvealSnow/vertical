<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Vertical Pole & Fitness</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">

    <script type="text/javascript" src="/assets/js/vendor/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="/assets/js/vendor/ui-select.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
    <script type="text/javascript" src="/assets/js/script.js"></script>

    <style>
        body{
            font-family: 'Lato';
            font-size: 16px;
        }

        @font-face {
            font-family: NexaBlack;
            src: url(../fonts/NexaBlack.otf);
        }

        @font-face {
            font-family: NexaBold;
            src: url(../fonts/NexaBold.otf);
        }

        @font-face {
            font-family: Lato;
            src: url(../fonts/Lato-Light.ttf);
        }

        @font-face {
            font-family: OstrichB;
            src: url(../fonts/OstrichSans-Bold.otf);
        }

        .login-btn{
            position: absolute;
            top: 0;
            right: 0;
            margin-top: 1em;
            margin-right: 1em;
            text-transform: uppercase;
            text-decoration: none !important;
        }
    </style>
</head>


    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    {{-- <script src="{{ elixir('js/script.js') }}"></script> --}}

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4QtFPY0X1tnL2MLkccqiWNR9eohXFCxI"></script>
<script type="text/javascript">
    var mapCanvas = document.getElementById("map");
    var myLatLng = {lat: 22.122655, lng: -101.028190};
    var mapOptions = {
        center: new google.maps.LatLng(myLatLng), zoom: 16
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
      });
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-62708614-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
