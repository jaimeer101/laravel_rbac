<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username', 
        'roles_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function roles(){
        return $this->belongsTo(Role::class, 'roles_id', 'id');   
    }

    public function hasPermission($permission = null){
        $response = false;
        $rolesPermission = $this->roles->roles_permission();
       
        if($rolesPermission->count() > 0){
            $response = true;
        }
        if($permission != ""){
            $response = false;
            $conditions = [['permissions_code','=',$permission]];
            $permissionDetails = (new Permission())->where($conditions)->first();
            $permissionId = $permissionDetails->id;
            $permissionsCondition = [['permissions_id','=',$permissionId]];
            $permissionsList = $this->roles->roles_permission()->where($permissionsCondition);
           
            if($permissionsList->count() != 0){
                $response = true;
            }
        }
        
        return $response;
    }
}
