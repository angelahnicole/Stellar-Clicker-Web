<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo (isset($title) ? $title :'Welcome'); ?> - Polymorphix Gaming</title>
        
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
    
    @include('master._partials.assets')
        
</head>
<body>

    <!-- NAVIGATION BAR -->
    @include('master._partials.navigation')  
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