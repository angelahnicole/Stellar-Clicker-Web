<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo (isset($title) ? $title :'Stellar Clicker: The Game'); ?> - Stellar Clicker - Polymorphix Gaming</title>
        
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
    
    
    @yield('scripts')

</body>
    
</html>