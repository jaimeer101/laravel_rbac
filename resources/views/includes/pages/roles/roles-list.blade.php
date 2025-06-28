<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users-cog"></i>
                    List
                </h3>
                <div class="card-tools">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add
                    </a>
                </div>
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($rolesList as $role)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $role->roles_code }}</td>
                                <td>{{ $role->roles_name }}</td>
                                <td>
                                    <div class="form-inline">
                                        @foreach ($permissionsList as $permission)
                                            @php
                                                $rolesPermission = $role->roles_permission()->where('permissions_id','=',$permission->id);
                                                $checked = "";
                                                if($rolesPermission->exists()){
                                                    $checked = "checked='checked'";
                                                }
                                            @endphp
                                            <div class="form-check ml-2">
                                                <input type="checkbox" class="form-check-input" disabled {{ $checked }}>
                                                <label class="form-check-label">{{ $permission->permissions_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary">
                                        <i class="fas fa-pencil"></i>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('roles.delete') }}" style="display:inline">
                                        @csrf
                                        <input type="hidden" name="hdn_roles_id" id="hdn_roles_id" value="{{ $role->id }}">
                                        <a href="{{ route('roles.delete') }}" onclick="event.preventDefault();
                                                                                    this.closest('form').submit();" class="btn btn-primary">
                                            <i class="fas fa-pencil"></i>
                                            Delete
                                        </a>
                                    </form> 
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