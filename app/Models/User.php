<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $request;
    public $result;
    public $error;
    public $user;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function AddUser()
    {
        $name = $this->request->input('name');
        $email = $this->request->input('email');
        $password = bcrypt($this->request->input('password'));
        $dep_id = $this->request->input('department');        try {
            $results = DB::select('CALL AddUser(?, ?, ?, ?)', [$email, $password, $name, $dep_id]);
            $this->result = "SignUp Successful";
            $this->icon = "success";
        } catch (\Exception $e) {
            //
            $this->result = "SignUp Successful";
            $this->icon = "error";
        }
    }

    public function Auth()
    {
        try{
            $this->user = DB::select('CALL Auth()');
            foreach ($this->user as $res) {
                $this->error=null;
                if (Hash::check($this->request->input("password"), $res->password) && $this->request->input("email") == $res->email) {
                    $this->result = $res;
                     // $this->error = "HERE ";
                    break;
                } else {
                    $this->error ="Login Failed Try again";
                }
            }
        }catch(\Exception $e){
            $this->error = $e->getMessage();

        }

    }
     public function GetEmployees(){

        return $results = DB::select('CALL getEmployees()');

     }
    public function GetUser(){

        $results = json_encode(DB::select('CALL GetUsers(?)',[session()->get("user")->Department_id]));
        echo  $results;

    }
    public function AssignRole(){
        try {
            $approve = $this->request->input('approve')? 1 : 0;
            $requester = $this->request->input('requester')  ? 1 : 0;
            $service = $this->request->input('service') ? 1 : 0;
            $personnel = $this->request->input('personnel')  ? 1 : 0;
            $role_id = $this->request->input('role_id');
            $uid = $this->request->input('users');
            $permission = $this->request->input('permission');
//
            DB::select('CALL UpdateRoles(?,?,?,?,?,?,?)', [$requester, $service, $personnel, $approve, $permission, $role_id, $uid]);
            $this->result="Success";
        }catch (\Exception $e){
            $this->result=$e->getMessage();

        }
    }
    public function AddRole(){
        try{
            $approve = $this->request->input('approve')? 1 : 0;
            $requester = $this->request->input('requester') ? 1 : 0;
            $service = $this->request->input('service')  ? 1 : 0;
            $personnel = $this->request->input('personnel')? 1 : 0;
            $uid = $this->request->input('users');
            $permission = $this->request->input('permission');
//
            DB::select('CALL AddRole(?,?,?,?,?,?)', [$requester, $service, $personnel, $approve, $uid, $permission]);
            $this->result="Success";
        }catch (\Exception $e){
            $this->error=$e->getMessage();

        }
    }

}
