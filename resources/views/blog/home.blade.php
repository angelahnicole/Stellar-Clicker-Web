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
    
    <div class="container-fluid text-center">
        {!! $posts->render() !!}
    </div>
    
    @foreach ($posts as $post)
    
    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
        <div class="col-xs-11"><h2>{{ $post->title_text }}<small>{{ $post->user->username }} // {{ $post->created_at->format('M j, Y') }}</small></h2></div>
    </div></div>
    
    <div class="front-page-panel">
        
        
                
        {!! Markdown::convertToHtml($post->body_text) !!}
        
        @if($user = \Sentinel::check())
        
            @if($user->inRole('admin') || $user->inRole('blogger'))
            
                <hr>
                
                <a href="{{ route('blog::post.edit' , ['post' => $post->id]) }}" class="text-uppercase pull-right" alt="Edit Blog Post Link" title="Edit Blog Post Link">Edit</a>
                
                <br><br>
                
             
            @endif
        
        @endif
        
    </div>
    
    <div class="comment-link-panel">
        
        <a href="{{ route('blog::post.show', ['post' => $post->id]) }}" alt="Full Post Link" title="Full Post Link">Full Post and Comments</a>
        
    </div>
    
    @endforeach
    
    <div class="container-fluid text-center">
        {!! $posts->render() !!}
    </div>
    
</section> 


@stop
<!-- /CONTENT -->

