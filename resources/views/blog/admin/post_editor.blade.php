@extends('master.master')

@section('assets')
@parent

<link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">


@stop

@section('content')


<section class="window" id="home">
    
    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-blog"></div></div>
        <div class="col-xs-11"><h2>The Post Editor</h2></div>
    </div></div>
    
    <div class="front-page-panel">
        
        @if(isset($post) && $post)
            <form class="form-horizontal" role="form" method="POST" action="{{ route('blog::post.update', ['id' => $post->id]) }}">
                {!! csrf_field() !!}
                {!! method_field('put') !!}

                    <div class="form-group{{ isset($errors) && $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-1 control-label">Post Title </label>

                        <div class="col-md-11">
                            <input type="text" class="form-control" name="title" value="{{ $errors->has('title') ? old('title') : $post->title_text }}">

                            @if (isset($errors) && $errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <textarea id='body_text' name='body_text'>{{ $post->body_text }}</textarea>

                    <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        <button type="submit" class="btn btn-default btn-block" style="margin-top:10px">
                            <i class="fa fa-btn fa-plus-square" style="color: #7B3599;"></i> Edit
                        </button>
                    </div>
                </div>

            </form>
        @else
            <form class="form-horizontal" role="form" method="POST" action="{{ route('blog::post.store') }}">
            {!! csrf_field() !!}

                <div class="form-group{{ isset($errors) && $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-md-1 control-label">Post Title </label>

                    <div class="col-md-11">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                        @if (isset($errors) && $errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <textarea id='body_text' name='body_text'></textarea>

                <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        <button type="submit" class="btn btn-default btn-block" style="margin-top:10px">
                            <i class="fa fa-btn fa-plus-square" style="color: #97D27A;"></i> Create
                        </button>
                    </div>
                </div>

            </form>
        @endif
        
        

                
    </div>
    
</section> 


@stop

@section('scripts')

<script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<script>

    $(document).ready(function()
    {
       var simplemde = new SimpleMDE({ element: $("#body_text")[0] }); 
       simplemde.render();
    });

</script>


@stop