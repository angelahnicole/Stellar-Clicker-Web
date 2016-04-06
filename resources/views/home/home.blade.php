@extends('master.master')

@section('content')

    
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