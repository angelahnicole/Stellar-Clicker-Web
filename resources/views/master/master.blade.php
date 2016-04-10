<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo (isset($title) ? $title :'Stellar Clicker: The Game'); ?> - Stellar Clicker - Polymorphix Gaming</title>
        
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('imx/favicon.ico')}}" />
    

    @include('master._partials.assets')
    @yield('assets')
        
</head>
<body>

    
    <!-- NAVIGATION BAR -->
    @if(isset($showNav) && $showNav)
        @include('master._partials.navigation')  
    @endif
    <!-- /NAVIGATION BAR -->
    
    
    @if(isset($showNotifications) && $showNotifications)
        <div class="container-fluid">   
            <div class="row">
                <div class="col-md-12">
                    @notification()              
                </div>
            </div>
        </div>
    @endif
     
        
    <!-- MAIN CONTAINER -->
    
    <div id="wrapper">
        <div id="main" class="container-fluid clear-top"> 
        
            @yield('page-header')
        
            <div class="row">
                @yield('content')
            </div>
                
        </div>
    </div>
          
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