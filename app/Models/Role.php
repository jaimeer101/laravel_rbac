<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["roles_code","roles_name","created_by", "updated_by"];
    protected $table = "roles";

    public function roles(){
        return $this->belongsTo(User::class, 'id', 'roles_id');   
    }

    public function roles_permission(){
        return $this->hasMany(RolePermission::class,'roles_id','id');
    }
}
