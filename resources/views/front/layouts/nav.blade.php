<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                    <?php
                    $category = \DB::table('site_category')->where('status', 1)->orderBy('id', 'asc')->get();
                     
                     ?>
    <div class="container">
         @foreach ($category as $cat)

                <form action="{{ route('categoryProd') }}" method="post">
                        {{ csrf_field()}}
                        <input type="hidden" name="id" value="{{ $cat->id }}">
                    <button type="submit" class="btn btn-primary btn-outline-light">{{$cat->name}}</button>
                    </form> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    
                    
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> {{ auth()->check() ? auth()->user()->name : 'Account' }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        @if (!auth()->check())
                            <a class="dropdown-item " href="{{  url('user/login') }}">Sign In</a>
                            <a class="dropdown-item" href="{{  url('user/register') }}">Sign Up</a>
                        @else
                            <a class="dropdown-item" href="{{  url('user/profile') }}"><i class="fa fa-user"></i> Profile</a>
                            <hr>
                            <a class="dropdown-item" href="{{  url('user/logout') }}"><i class="fa fa-lock"></i> Logout</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
