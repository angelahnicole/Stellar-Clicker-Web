@extends('master.master')

<!-- CONTENT -->
@section('content')


<section class="window" id="home">

    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
        <div class="col-xs-11"><h2>Manage Blog Posts</h2></div>
    </div></div>
    
    <div class="front-page-panel">
        
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
                <td>{{ $post->title_text }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->user->username }}</td>
                <td><a href="{{ route('blog::post.edit', ['post' => $post->id]) }}"><span class="fa fa-edit"></a><span class="sr-only"> Edit</span></a></td>
                <td><a href="{{ route('blog::post.destroy', ['post' => $post->id]) }}"><span class="fa fa-remove"></a><span class="sr-only"> Delete</span></a></td>
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

