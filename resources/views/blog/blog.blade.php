@extends('master.master')

<!-- CONTENT -->
@section('content')


<section class="window" id="home">
    
    <div class="redirect-container">
        <a href="{{ url()->previous() }}" alt="Redirect Back Link" title="Redirect Back Link"><span class="glyphicon glyphicon-menu-left"></span> Back</a>
    </div>

    
    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
        <div class="col-xs-11"><h2>{{ $post->title_text }}<small>{{ $post->user->username }} // {{ $post->created_at->format('M j, Y') }}</small></h2></div>
            
            
    </div></div>
    
    <div class="front-page-panel">
                
        {!!  Markdown::convertToHtml($post->body_text) !!}
        
        <hr/>
        
        @if(\Sentinel::guest())
        
        <div class="row"><div class="col-md-12">
            <a class="btn btn-default btn-block" href="{{ route('blog::user.login') }}" style="margin-bottom:10px">
                <i class="fa fa-btn fa-sign-in"></i> Login to Comment
            </a>
        </div></div>
        
        @endif
        
        <div id="comments-container"></div>

                
    </div>
    
    
    
</section> 


@stop

@section('scripts')
@parent

<script>
    
    
    $(document).ready(function()
    {
        $.ajaxSetup
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#comments-container').comments
        ({
            enableUpvoting: false,
            enableEditing: true,
            @if(\Sentinel::guest())
            enableReplying: false,
            @endif
            
            fieldMappings: 
            {
                id: 'id',
                parent: 'blog_comment_parent_id',
                created: 'created_at',
                modified: 'updated_at',
                content: 'body_text',
                fullname: 'username',
                createdByAdmin: 'created_by_admin',
                createdByCurrentUser: 'created_by_current_user'
            },
            
            getComments: function(success, error) 
            {
                var getURL = "{{ route('api.post.comment.index', ['post' => $post->id]) }}";
                
                $.ajax
                ({
                    type: 'get',
                    url: getURL,
                    success: function(commentsArray) 
                    {
                        success(commentsArray);
                    },
                    error: error
                });

            },
            
            postComment: function(commentJSON, success, error) 
            {
                var postURL = "{{ route('api.post.comment.store', ['post' => $post->id]) }}";
                
                $.ajax
                ({
                    type: 'post',
                    url: postURL,
                    data: commentJSON,
                    success: function(comment) 
                    {
                        success(comment);
                    },
                    error: error
                });

            },
            
            putComment: function(commentJSON, success, error) 
            {
                var putURL = "/api/post/{{ $post->id }}/comment/" + commentJSON.id;
                
                $.ajax
                ({
                    type: 'put',
                    url: putURL,
                    data: commentJSON,
                    success: function(comment) 
                    {
                        success(comment);
                    },
                    error: error
                });
            },
            
            deleteComment: function(commentJSON, success, error) 
            {
                var deleteURL = "/api/post/{{ $post->id }}/comment/" + commentJSON.id;
                
                $.ajax
                ({
                    type: 'delete',
                    url: deleteURL,
                    success: success,
                    error: error
                });
            }
        });
        
        @if(\Sentinel::guest())

        $(window).load(function()
        {
           disableReplying(); 
        });

        @endif
    });
    
</script>



@stop

<!-- /CONTENT -->

