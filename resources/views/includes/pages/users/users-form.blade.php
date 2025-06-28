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
    $formAction = isset($user) ? "users.update" : "users.store";
    $formHeader = isset($user) ? "Update" : "Add";
@endphp
<div class="row">
    <div class="col-lg-6">
        <form name="frmUsers" id="frmUsers" method="POST" action="{{ route($formAction) }}">
            @csrf
            @isset($user)
                <input type="hidden" name="hdn_users_id" id="hdn_users_id" value="{{ $user->id }}">
            @endisset
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i>
                        {{ $formHeader }} Form
                    </h3>
                    
                    <div class="card-tools">
                        <a href="{{ route('users') }}" class="btn btn-primary">
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
                        <label for="txt_name">Name</label>
                       @php
                            $name = isset($user) ? $user->name : "";
                       @endphp
                        <input 
                            type="text" 
                            class="form-control @error("txt_name", 'users') is-invalid @enderror" 
                            name="txt_name" 
                            id="txt_name" 
                            placeholder="Enter name" 
                            value="{{ old("txt_name", $name) }}">
                        @error("txt_name", 'users')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="txt_username">Username</label>
                        @php
                            $userName = isset($user) ? $user->username : "";
                        @endphp
                        <input 
                            type="text" 
                            class="form-control @error("txt_username", 'users') is-invalid @enderror" 
                            name="txt_username" 
                            id="txt_username" 
                            placeholder="Enter username"
                            value="{{ old("txt_username", $userName) }}">
                         @error("txt_username", 'users')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="txt_email">Email</label>
                        @php
                            $email = isset($user) ? $user->email : "";
                        @endphp
                        <input 
                            type="email" 
                            class="form-control @error("txt_email", 'users') is-invalid @enderror" 
                            name="txt_email" 
                            id="txt_email" 
                            placeholder="Enter email"
                            value="{{ old("txt_email", $email) }}">
                         @error("txt_email", 'users')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="txt_password">Password</label>
                        <input type="password" class="form-control @error("txt_password", 'users') is-invalid @enderror" name="txt_password" id="txt_password" placeholder="Enter password">
                         @error("txt_password", 'users')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="slt_role">Role</label>
                        @php
                            $rolesId = isset($user) ? $user->roles_id : "";
                        @endphp
                        <select name="slt_role" id="slt_role" class="form-control @error("slt_role", 'users') is-invalid @enderror">
                            <option value="">Please select a role</option>
                            @foreach ($rolesList as $roles)
                                <option value="{{ $roles->id }}" @if(old("slt_role", $rolesId) == $roles->id) selected @endif>{{ $roles->roles_name }}</option>
                            @endforeach
                        </select>
                         @error("slt_role", 'users')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                </div>
                <div class = "card-footer">
                    <button type="submit" class ="btn btn-success">SAVE</button>
                </div>
            </div>
        </form>
        
    </div>
</div>