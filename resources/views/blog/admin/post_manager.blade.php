@extends('master.master')

<!-- CONTENT -->
@section('content')


<section class="window" id="home">

    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
        <div class="col-xs-11"><h2>Manage Blog Posts</h2></div>
    </div></div>
    
    <div class="front-page-panel">
        
        <a class="btn btn-default pull-right" href="{{ route('blog::post.create') }}" style="margin-bottom:10px">
            <i class="fa fa-btn fa-plus-square" style="color: #97D27A;"></i> Create New Blog Post
        </a>
        
        <table class="table table-striped">
            
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th>Author Username</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            
            @foreach ($posts as $post)
            
            <tr>
                <td><a href="{{ route('blog::post.show', ['post' => $post->id]) }}" alt="Full Post Link" title="Full Post Link">{{ $post->title_text }}</a></td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->user->username }}</td>
                <td><a class="btn btn-link" style="color: #7B3599;" href="{{ route('blog::post.edit', ['post' => $post->id]) }}"><span class="fa fa-edit"><span class="sr-only"> Edit</span></a></td>
                <td>
                    <form role="form" class="form-inline" method="POST" action="{{ route('blog::post.destroy', ['post' => $post->id]) }}">
                        {!! csrf_field() !!}
                        {!! method_field('delete') !!}
                        <button type="submit" class="btn btn-link" data-confirm="Are you sure?">
                            <i class="fa fa-btn fa-remove" style="color: #7B3599;"></i> <span class="sr-only">Delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            
            @endforeach
            
            
        </table>

        
    </div>
    
    
    
    <div class="container-fluid text-center">
        {!! $posts->render() !!}
    </div>
    
</section> 


@stop
<!-- /CONTENT -->

