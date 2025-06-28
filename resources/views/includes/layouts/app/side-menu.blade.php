<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="index3.html" class="brand-link">
      Laravel RBAC
    </a>
	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{ asset('storage/images/profile/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">{{ Auth::user()->name }}</a>
			</div>
		</div>
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item ">
					<a href="{{ route('index') }}" class="nav-link @if(Route::currentRouteName() == 'index') active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
                @if (Auth::user()->hasPermission())
                    <li class="nav-item ">
                        <a href="{{ route('users') }}" class="nav-link @if(Route::currentRouteName() == 'users') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                @endif
                
                @if(Auth::user()->roles_id == 1)
                    <li class="nav-item ">
                        <a href="{{ route('roles') }}" class="nav-link @if(Route::currentRouteName() == 'roles') active @endif">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Roles
                            </p>
                        </a>
                    </li>
                @endif
                
                <li class="nav-item ">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </form>
				</li>
			</ul>
		</nav>
	</div>
</aside>