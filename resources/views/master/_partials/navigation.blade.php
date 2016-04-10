<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid nav-container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('stellar::home') }}">Stellar Clicker </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
      <ul class="nav navbar-nav navbar-right" id="#main-nav">
        <li><a href="{{ route('blog::home') }}" class="front-nav" id="blog-nav"> The Blog</a></li>
        <li><a href="http://forum.stellar.polymorphixgaming.com" class="front-nav" id="forum-nav"> The Forum</a></li>
        <li><a href="{{ route('wiki::home') }}" class="front-nav" id="wiki-nav"> The Wiki</a></li>
        
        @if(isset($showLogin) && $showLogin)
        
            <li class='divider-vertical'></li>

            @if($user = \Sentinel::check())    
                <li class="dropdown user-text">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $user->username }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        @if($user->inRole('admin'))
                            <li><a href="{{ route('blog::user.manage') }}">Manage Users</a></li>
                        @endif
                        
                        @if($user->inRole('admin') || $user->inRole('blogger'))
                            <li><a href="{{ route('blog::post.manage') }}">Manage Blog Posts</a></li>
                        @endif
                        
                        <li><a href="{{ route('blog::user.edit', ['user' => $user->id]) }}">Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('blog::user.logout') }}">Logout</a></li>
                    </ul>
                </li>
            @else
                <li><a href="{{  route('blog::user.login') }}" class="front-nav" id="wiki-nav"> Login</a></li>
            @endif
        
        @endif
        
      </ul>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>