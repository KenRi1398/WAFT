<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Result;

class UserLogs extends Model
{
    use HasFactory;
    public $result;
    public $error;
    public $request;

    public function AddUserLogs()
    {
        try {
            if($this->request->input('status')=="2") {
                $randomNumber = mt_rand(1000, 9999);
                $token = str($randomNumber) . $this->request->input('id');
                session()->put("userlog_token",$token);
            }else{
                $token= $this->request->input("userlog_token");
            }
            $uid=session()->get("user")->id;
            $tid=$this->request->input('id');
            $sid=$this->request->input('status');
            $remarks=$this->request->input('remarks');
            DB::select('CALL AddUserlogs(?,?,?,?,?)', [$token,$uid,$tid,$sid,$remarks]);
           $this->result="Status Update Success";
        } catch (\Exception $e) {
           $this->error = $e->getMessage();
        }
    }
}
