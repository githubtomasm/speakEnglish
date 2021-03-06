<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- <link rel="stylesheet" href="css/normalize.css"> -->
        <!-- <link rel="stylesheet" href="css/main.css"> -->
        <!--<script src="js/vendor/modernizr-2.8.3.min.js"></script>-->
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 --}}
        <link rel="stylesheet" href="/assets/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/bootstrap.min.css">

        {{-- sweet alert --}}
       <link rel="stylesheet" href="/assets/vendor/sweetalert-master/dist/sweetalert.css">

    
        @yield('page-styles')

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->





        
        <div class="container">
            


            @yield('content')

        </div>            

        
        @yield('footer')
    

        

        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>-->

        <script src="/assets/jquery.min.js"></script>
        <script src="/assets/jquery-ui.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="/assets/bootstrap.min.js"></script>

        {{-- bootstrap tables     --}}
            {{-- http://bootstrap-table.wenzhixin.net.cn/getting-started/ --}}
        <link rel="stylesheet" href="/assets/bootstrap-table.min.css">
        <script src="/assets/bootstrap-table.min.js"></script>
   


        {{--angular 1.4 y sortable plugin--}}

        <script type="text/javascript" src="/assets/angular.min.js"></script>
        <script type="text/javascript" src="/assets/sortable.js"></script>
        
        {{-- sweet alert         --}}
        <script src='/assets/vendor/sweetalert-master/dist/sweetalert.min.js'></script>

        {{-- boot angular 
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui/0.4.0/angular-ui.min.js"></script>    
        --}}




        {{-- page specific scrips --}}
        @yield('page-scripts')     
        


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. 
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>-->



        @include('flash')



    </body>
</html>
