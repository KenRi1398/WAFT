<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\Department as Department;

class UserController extends Controller
{
    private $user;
    private $department;
    public function __construct()
    {
        $this->user = new User;
        $this->department = new Department;
    }
    public function AddUser(Request $request)
    {
          $this->user->request = $request;
          $this->user->AddUser();
        return view('Login/SignUp')->with('user', $this->user)->with('department', $this->department);

    }
    public function SignupPage()
    {
        return view('Login/SignUp')->with('department', $this->department);

    }
    public function UserPage()
    {
        return view('User/User')->with('user', $this->user);
    }
    public function Authenticate(Request $request)
    {
        $this->user->request = $request;
        $this->user->Auth();
        if (isset($this->user->result)) {
            session()->put('user', $this->user->result);
        }
        return view('welcome')->with('department', $this->department)->with('user', $this->user);

    }
    public function Logout()
    {
        session()->put("user", null);
        return redirect("/");

    }
    public function userrole()
    {
       return view('User/AssignRole')->with('user', $this->user);
    }
    public function AssignRole(Request $request)
    {
        $this->user->request = $request;
        $result="";
        if ($request->input('role_id')){
            $this->user->AssignRole();
        }else{
            $this->user->AddRole();
        }
        return $this->user->result;
    }
}
