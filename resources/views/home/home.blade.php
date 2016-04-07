@extends('master.master')

@section('content')


<section class="window" id="home">
    
    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-blog"></div></div>
        <div class="col-xs-11"><h2>The Game <small>What is it?</small></h2></div>
    </div></div>
    
    <div class="embed-responsive embed-responsive-16by9">
        <iframe width="1280" height="720" src="https://www.youtube.com/embed/ScMzIvxBSi4" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <h2>Downloads</h2>
    
    <div class="container-fluid"><div class="row">

        <div class="col-lg-1"></div>    
        
        <a href="#" title="Windows Download Link" alt="Windows Download Link" class="download-block-link">
            <div class="col-lg-2 windows-download-block">
                <span class="glyphicon icon-windows"></span> Windows
            </div>
        </a>
        
        <a href="#" title="Linux Download Link" alt="Linux Download Link" class="download-block-link">
            <div class="col-lg-2 linux-download-block disabled">
                <span class="glyphicon icon-linux"></span> Linux
            </div>
        </a>
        
        <a href="#" title="OS X Download Link" alt="OS X Download Link" class="download-block-link">
            <div class="col-lg-2 osx-download-block disabled">
                <span class="glyphicon icon-osx"></span> OS X
            </div>
        </a>
        
            
        <a href="#" title="Android Download Link" alt="Android Download Link" class="download-block-link">
            <div class="col-lg-2 android-download-block disabled">
                <span class="glyphicon icon-android"></span> Android
            </div>
        </a>
        
        <a href="#" title="iOS Download Link" alt="iOS Download Link" class="download-block-link">
            <div class="col-lg-2 ios-download-block disabled">
                <span class="glyphicon icon-ios"></span> iOS
            </div>
        </a>
        
        <div class="col-lg-1"></div>
    </div></div>
        
    

</section>
            
    
<section class="window" id="blog">

    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-blog"></div></div>
        <div class="col-xs-11"><h2>Developer's Blog <small>What in the world are they thinking?</small></h2></div>
    </div></div>
        
    <a href="https://blog.stellar.polymorphixgaming.com" class="banner-link-blog" title="Developer's Blog Link"></a>
        

</section> <!-- /DEVELOPER'S BLOG -->

<section class="window leaderboard-window" id="forum">

     <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-forum"></div></div>
        <div class="col-xs-11"><h2>Game Forum <small>What in the world are you thinking?</small></h2></div>
    </div></div>
    
    <a href="https://forum.stellar.polymorphixgaming.com" class="banner-link-forum" title="Game Forum Link"></a>
    

</section> <!-- /GAME FORUM -->
 
<section class="window leaderboard-window" id="wiki">

     <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-wiki"></div></div>
        <div class="col-xs-11"><h2>Game Wiki <small>What does it mean?</small></h2></div>
    </div></div>
    
    <a href="https://wiki.stellar.polymorphixgaming.com" class="banner-link-wiki" title="Game Wiki Link"></a>
    
</section> <!-- /GAME WIKI -->


@stop

@section('scripts')


@append