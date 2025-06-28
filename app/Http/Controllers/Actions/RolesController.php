<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $permission;
    public function __construct(){
        $this->permission = new Permission();
    }
    public function index()
    {
        $page = "form";
        $permissionsList = $this->permission->get();
        return view('pages.roles')->with([
            'page'=> $page, 
            'permissionsList' => $permissionsList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = "";
        $message = "";
        $response = array();

        $rules = [
            'txt_roles_code' => 'required|unique:roles,roles_code', 
            'txt_roles_name' => 'required|unique:roles,roles_name'
        ];
        $message = [
            'txt_roles_code.required' => 'Code is required',
            'txt_roles_code.unique' => 'Code must be unique',
            'txt_roles_name.required' => 'Name is required',
            'txt_roles_name.unique' => 'Name must be unique'
        ];
        $validateData = $request->validateWithBag('roles',$rules , $message);
        $submitData = [
            'roles_code' => $validateData["txt_roles_code"],
            'roles_name' => $validateData["txt_roles_name"],
            'created_by' => Auth::user()->id
        ];
        $role = Role::create($submitData);
        $type = "success";
        $message = "New Role created successfully";
        if(is_numeric($role->id)){
            if($request->get("chkbox_permissions")){
                $rolesPermissionData = [];
                foreach($request->get("chkbox_permissions") as $permissions){
                    $rolesPermissionData[] = array(
                        'roles_id' => $role->id,
                        'permissions_id' => $permissions, 
                        'created_by' => Auth::user()->id, 
                        'created_at' => date("Y-m-d H:i:s")
                    );
                }
                
                $rolePermission = RolePermission::insert($rolesPermissionData);
               
                if(!$rolePermission){
                    $type = "danger";
                    $message = $rolePermission;
                } 
            }
        }
        $response = array(
            "type"=> $type,
            "message" => $message
        );
        return redirect()->route('roles.index')->with($response); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role, $id)
    {
        $page = "form";
        $role = Role::where('id','=',$id)->first();
        $permissionsList = $this->permission->get();
        return view('pages.roles')->with([
            'page'=> $page, 
            'permissionsList' => $permissionsList, 
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $type = "";
        $message = "";
        $response = array();
        $rolesId = $request->get("hdn_roles_id");
        $rules = [
            'txt_roles_code' => 'required|unique:roles,roles_code,'.$rolesId, 
            'txt_roles_name' => 'required|unique:roles,roles_name,'.$rolesId
        ];
        $message = [
            'txt_roles_code.required' => 'Code is required',
            'txt_roles_code.unique' => 'Code must be unique',
            'txt_roles_name.required' => 'Name is required',
            'txt_roles_name.unique' => 'Name must be unique'
        ];
        $validateData = $request->validateWithBag('roles',$rules , $message);
        $submitData = [
            'roles_code' => $validateData["txt_roles_code"],
            'roles_name' => $validateData["txt_roles_name"],
            'updated_by' => Auth::user()->id
        ];
        $role = Role::where('id', $rolesId)->update($submitData);
        $type = "success";
        $message = "Role update successful";
        if(!is_numeric($role)){
            $type = "danger";
            $message = "Role".$role;
        }
        if($type == "success"){
            $deleteRolesPermissions = RolePermission::where("roles_id", $rolesId)->delete();  
            if(!is_numeric($deleteRolesPermissions)){
                $type = "danger";
                $message = "Delete Permission ".$deleteRolesPermissions;
            }
        }
        if($type == "success"){
            if($request->get("chkbox_permissions")){
                $rolesPermissionData = [];
                foreach($request->get("chkbox_permissions") as $permissions){
                    $rolesPermissionData[] = array(
                        'roles_id' => $rolesId,
                        'permissions_id' => $permissions, 
                        'created_by' => Auth::user()->id, 
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_by' => Auth::user()->id, 
                        'updated_at' => date("Y-m-d H:i:s")
                    );
                }
                
                $rolePermission = RolePermission::insert($rolesPermissionData);
               
                if(!$rolePermission){
                    $type = "danger";
                    $message = "Insert Permission ".$rolePermission;
                } 
            }
        }
        $response = array(
            "type"=> $type,
            "message" => $message
        );
        return redirect()->route('roles.show', $rolesId)->with($response);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $rolesId = $request->hdn_roles_id;
        $deleteRole = Role::where('id', $rolesId)->delete();
        $type = "success";
        $message = "Role delete successful";
        if(!$deleteRole){
            $type = "danger";
            $message = $deleteRole;
        }

        if($type == "success"){
            $deleteRolesPermissions = RolePermission::where("roles_id", $rolesId)->delete();  
            if(!is_numeric($deleteRolesPermissions)){
                $type = "danger";
                $message = $deleteRolesPermissions;
            }
        }
        
        $response = array(
            "type"=> $type,
            "message" => $message
        );
        return redirect()->route('roles')->with($response);
    }
}
