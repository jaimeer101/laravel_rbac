<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNumeric;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $roles;
    public function __construct(){
        $this->roles = new Role();
    }
    public function index()
    {
        $page = "form";

        $rolesList = $this->roles;
        if(Auth::user()->roles_id != 1){
            $rolesList->where('id', '!=', 1);
        }
        //print_r($rolesList);
        return view('pages.users')->with([
            'page'=> $page, 
            'rolesList' => $rolesList->get()
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
            'txt_name' => 'required', 
            'txt_username' => 'required|unique:users,username,'.Auth::user()->id, 
            'txt_email' => 'required|email|unique:users,email,'.Auth::user()->id, 
            'txt_password' => 'required', 
            'slt_role' => 'required'
        ];
        $message = [
            'txt_name.required' => 'Name is required',
            'txt_username.required' => 'Username is required',
            'txt_username.unique' => 'Username must be unique',
            'txt_email.required' => 'Email is required',
            'txt_email.email' => 'Email is invalid',
            'txt_email.unique' => 'Email must be unique',
            'txt_password.required' => 'Password is required',
            'slt_role.required' => 'Role is required'
        ];
        $validateData = $request->validateWithBag('users',$rules , $message);
        $submitData = [
            'name' => $validateData["txt_name"],
            'username' => $validateData["txt_username"],
            'email' => $validateData["txt_email"],
            'password' => $validateData["txt_password"],
            'roles_id' => $validateData["slt_role"]
        ];
        $user = User::create($submitData);
        $type = "success";
        $message = "New User created successfully";
        if(!is_numeric($user->id)){
            $type = "danger";
            $message = $user;
        }
        $response = array(
            "type"=> $type,
            "message" => $message
        );
        return redirect()->route('users.index')->with($response); 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $page = "form";

        $rolesList = $this->roles;
        $user = User::where('id','=',$id)->first();
        if(Auth::user()->roles_id != 1){
            $rolesList = $rolesList->where('id', '=', $user->roles_id);
        }
        
        
        return view('pages.users')->with([
            'page'=> $page, 
            'rolesList' => $rolesList->get(), 
            'user'=> $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $type = "";
        $message = "";
        $response = array();
        $usersId = $request->hdn_users_id;
        $rules = [
            'txt_name' => 'required', 
            'txt_username' => 'required|unique:users,username,'.$usersId, 
            'txt_email' => 'required|email|unique:users,email,'.$usersId,
            'slt_role' => 'required'
        ];
        $message = [
            'txt_name.required' => 'Name is required',
            'txt_username.required' => 'Username is required',
            'txt_username.unique' => 'Username must be unique',
            'txt_email.required' => 'Email is required',
            'txt_email.email' => 'Email is invalid',
            'txt_email.unique' => 'Email must be unique',
            'slt_role.required' => 'Role is required'
        ];
        $validateData = $request->validateWithBag('users',$rules , $message);
        $submitData = [
            'name' => $validateData["txt_name"],
            'username' => $validateData["txt_username"],
            'email' => $validateData["txt_email"],
            'roles_id' => $validateData["slt_role"]
        ];

        if($request->get("txt_password") != ""){
            $submitData["password"] = bcrypt($request->get("txt_password"));    
        }

        $user = User::where('id', $usersId)->update($submitData);
        $type = "success";
        $message = "User update successful";
        if(!is_numeric($user)){
            $type = "danger";
            $message = $user;
        }
        $response = array(
            "type"=> $type,
            "message" => $message
        );
        return redirect()->route('users.show', $usersId)->with($response); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $usersId = $request->hdn_users_id;
        $deleteUser = User::where('id', $usersId)->delete();
        $type = "success";
        $message = "User delete successful";
        if(!is_numeric($deleteUser)){
            $type = "danger";
            $message = $deleteUser;
        }
        $response = array(
            "type"=> $type,
            "message" => $message
        );
        return redirect()->route('users')->with($response); 
    }
}
