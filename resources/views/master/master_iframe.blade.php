<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo (isset($title) ? $title :'Stellar Clicker: The Game'); ?> - Polymorphix Gaming</title>
        
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('imx/favicon.ico')}}" />
    
    @include('master._partials.assets')
    @yield('assets')
    
    <link rel="stylesheet" href="{{ asset('css/iframe.css') }}">
        
</head>
<body>

    
    <!-- NAVIGATION BAR -->
    @if(isset($showNav) && $showNav)
        @include('master._partials.navigation')  
    @endif
    <!-- /NAVIGATION BAR -->
    
    
    @if(isset($showDefaultNotifcations) && $showDefaultNotifcations)
        <div class="container-fluid">   
            <div class="row">
                <div class="col-md-12">
                    {{-- NOTIFICATIONS --}}
                     @include('master._partials.notifications')               
                </div>
            </div>
        </div>
    @endif
     
        
    <!-- MAIN CONTAINER -->

    @yield('content')

          
    <!-- /MAIN CONTAINER -->
    
    
    {{-- FOOTER --}}
    
    <div class="footer">
    
        <div class="container-fluid">
                polymorphix gaming 2016 :)       
        </div>
    </div>
    
    <!-- /FOOTER -->
    
    
    @yield('scripts')

</body>
    
</html>