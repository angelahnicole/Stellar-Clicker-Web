@extends('master.master')

<!-- CONTENT -->
@section('content')


<section class="window" id="home">
    
    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
        <div class="col-xs-11"><h2>Manage Users</h2></div>
    </div></div>
    
    <div class="front-page-panel">
        
        <table class="table table-striped">
            
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Is Admin</th>
                <th>Is Blogger</th>
                <th>Edit</th>
            </tr>
            
            @foreach ($users as $user)
            
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td><input class="disabled" type="checkbox" name="is_admin" {{ $user->inRole('admin') ? 'checked' : '' }}></td>
                <td><input class="disabled" type="checkbox" name="is_blogger" {{ $user->inRole('blogger') ? 'checked' : '' }}></td>
                <td><a href="{{ route('blog::user.edit', ['user' => $user->id]) }}"><span class="fa fa-edit"></a><span class="sr-only"> Edit</span></a></td>
            </tr>
            
            @endforeach
            
            
            
            
        </table>

        
    </div>
    
    
    
    <div class="container-fluid text-center">
        {!! $users->render() !!}
    </div>
    
</section> 


@stop
<!-- /CONTENT -->

