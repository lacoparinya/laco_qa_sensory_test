
<div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->laconame }} - {{App\User::find(Auth::user()->id)->group->name}} <span class="caret"></span>
                                </a>
                            
                                @if ( App\User::find(Auth::user()->id)->group->role == 'admin'  )
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                    <a href="{{route('qa-sample-datas.index')}}">QA Sample Data</a>
                                    </li>
                                    <li>
                                    <a href="{{route('sensory-masters.index')}}">Sensory Test</a>
                                    </li>
                                    <li>
                                    <a href="{{route('users.index')}}">User</a>
                                    </li>
                                    <li><hr/></li>
                                    <li>
                                    <a href="{{route('sensory-masters.index')}}">Daily Report</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                @else
                                <ul class="dropdown-menu" role="menu">
                                     <li>
                                    <a href="{{route('sensory-masters.index')}}">Daily Report</a>
                                    </li>
                                    <li><hr/></li>
                                     <li>
                                    <a href="{{route('sensory-masters.index')}}">Daily Report</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
