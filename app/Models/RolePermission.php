<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
       'roles_id','permissions_id', 'created_by'
    ];
    protected $table = "roles_permissions";

    public function roles(){
        return $this->belongsTo(Role::class,"roles_id","id");
    }

    public function permissions(){
        return $this->belongsTo(Permission::class,"permissions_id","id");
    }
}
