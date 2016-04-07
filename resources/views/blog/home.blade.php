@extends('master.master')

<!-- ASSETS -->
@section('assets')

@parent

<link rel="stylesheet" href="{{ asset('css/blog.css') }}">

@stop
<!-- /ASSETS -->

<!-- CONTENT -->
@section('content')


<section class="window" id="home">
    
<div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-blog"></div></div>
        <div class="col-xs-11"><h2>The Blog Home <small>Ahhh yeah.</small></h2></div>
    </div></div>
    
</section> 


@stop
<!-- /CONTENT -->

