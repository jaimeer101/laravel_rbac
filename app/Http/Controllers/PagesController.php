<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(){
        return view('pages.index');
    }
    public function login(){
        return view('pages.login');
    }

    public function users(){
        $page = "list";
        $usersList = (new User())->where('roles_id', '!=', 1)->get();
        return view('pages.users')->with([
            'usersList'=> $usersList, 
            'page'=> $page
        ]);
    }

    public function roles(){
        $page = "list";
        $rolesList = (new Role())->where('id', '!=', 1)->get();
        $permissionsList = (new Permission())->get();
        return view('pages.roles')->with([
            'page'=> $page, 
            'rolesList'=> $rolesList, 
            'permissionsList' => $permissionsList
        ]);
    }

    public function permissions(){
        return view('pages.permissions');
    }
}
