<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i>
                    List
                </h3>
                @if (Auth::user()->hasPermission("create"))
                    <div class="card-tools">
                        <a href="{{ route('users.index') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add
                        </a>
                    </div>
                @endif
            </div>
            <div class = "card-body">
                @if (session('type'))
                    <div class = "alert alert-{{ session('type') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($usersList as $users)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $users->username }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->roles()->first()->roles_name }}</td>
                                <td>
                                    @if (Auth::user()->hasPermission("update"))
                                        
                                        <a href="{{ route('users.show', $users->id) }}" class="btn btn-primary">
                                            <i class="fas fa-pencil"></i>
                                            Edit
                                        </a>
                                    @endif
                                    @if (Auth::user()->hasPermission("delete"))
                                        <form method="POST" action="{{ route('users.delete') }}" style="display:inline">
                                            @csrf
                                            <input type="hidden" name="hdn_users_id" id="hdn_users_id" value="{{ $users->id }}">
                                            <a href="{{ route('users.delete') }}" onclick="event.preventDefault();
                                                                                        this.closest('form').submit();" class="btn btn-primary">
                                                <i class="fas fa-pencil"></i>
                                                Delete
                                            </a>
                                        </form> 
                                    @endif
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>