<style>
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }
</style>
@php
    $formAction = isset($role) ? "roles.update" : "roles.store";
    $formHeader = isset($role) ? "Update" : "Add";
@endphp
<div class="row">
    <div class="col-lg-6">
        <form name="frmRoles" id="frmRoles" method="POST" action="{{ route($formAction) }}">
            @csrf
            @isset($role)
                <input type="hidden" name="hdn_roles_id" id="hdn_roles_id" value="{{ $role->id }}">
            @endisset
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i>
                        {{ $formHeader }} Form
                    </h3>
                    
                    <div class="card-tools">
                        <a href="{{ route('roles') }}" class="btn btn-primary">
                            <i class="fas fa-back"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class = "card-body">
                    @if (session('type'))
                        <div class = "alert alert-{{ session('type') }}">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="txt_roles_code">Code</label>
                       @php
                            $rolesCode = isset($role) ? $role->roles_code : "";
                       @endphp
                        <input 
                            type="text" 
                            class="form-control @error("txt_roles_code", 'roles') is-invalid @enderror" 
                            name="txt_roles_code" 
                            id="txt_roles_code" 
                            placeholder="Enter Code" 
                            value="{{ old("txt_roles_code", $rolesCode) }}">
                        @error("txt_roles_code", 'roles')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="txt_roles_name">Name</label>
                       @php
                            $rolesName = isset($role) ? $role->roles_name : "";
                       @endphp
                        <input 
                            type="text" 
                            class="form-control @error("txt_roles_name", 'roles') is-invalid @enderror" 
                            name="txt_roles_name" 
                            id="txt_roles_name" 
                            placeholder="Enter Name" 
                            value="{{ old("txt_roles_name", $rolesName) }}">
                        @error("txt_roles_name", 'roles')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="chkbox_permissions">Roles</label>
                        <div class="form-inline">
                            @foreach ($permissionsList as $permission)
                               @php
                                    $checked = "";
                                    if(isset($role)){
                                        $rolesPermission = $role->roles_permission()->where('permissions_id','=',$permission->id);
                                        $checked = "";
                                        if($rolesPermission->exists()){
                                            $checked = "checked='checked'";
                                        }
                                    }
                                    
                                @endphp
                                <div class="form-check ml-2">
                                    <input type="checkbox" class="form-check-input" name="chkbox_permissions[]" value="{{ $permission->id }}" {{ $checked }}>
                                    <label class="form-check-label">{{ $permission->permissions_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class = "card-footer">
                    <button type="submit" class ="btn btn-success">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</div>