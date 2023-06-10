<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    public $request;
    public $icon;
    public $result;
    public $error;
    public $department_id = 0;
    public $user_id = 0;
    public $status_id=0;
    public $data = [];

    public function AddTicket()
    {


        $department_id = $this->request->input('branch_department');
        $requester_department_id = $this->request->input('addressto');
        $name = $this->request->input('name');
        $email = $this->request->input('company_email');
        $position = $this->request->input('position');
        $ticket_subject = $this->request->input('subject');
        $ticket_description = $this->request->input('description');
        //ticket code
        $branchDepartmentName = $this->request->input("branch_department_name");
        $currentDate = new \DateTime();
        $timestamp = strval($currentDate->format('ymd')) . "-" . strval($currentDate->format('U'));
        $ticket_code = $branchDepartmentName . $timestamp;
        //end
        try {
            $results = DB::select('CALL AddTicket(?, ?, ?, ?, ?, ?, ?, ?, ?)',[ $position, $email,$name, $department_id, $requester_department_id, $ticket_subject, $ticket_description, session()->get("user")->id,$ticket_code]);
            $this->result = "Add Ticket Succeed";
            $this->icon = "success";
            return $results;
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
            $this->icon = "error";

            return $this->result;

        }
    }
    public function getTickets()
    {
        // $this->result = self::all();
        $this->results = DB::select('CALL GetTickets(?,?)', [$this->department_id, $this->user_id]);

        return response()->json($this->results);
    }
    public function SetInstruction()
    {
        // $this->result = self::all();
        try {
            $this->results = DB::select('CALL ticketInstruction(?,?,?,?,?,?)', [$this->request->input("priority"), $this->request->input("class"), $this->request->input("status"), $this->request->input("issue"), $this->request->input("employee"), $this->request->input("id")]);
            $this->result = "Instruction Successful";
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    public function getTasks()
    {
        try {
            $this->results = DB::select('CALL GetTask(?,?)', [$this->user_id,$this->department_id]);
            return response()->json($this->results);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    public function TransferTask()
    {
        try {
            $uid=$this->request->input('uid');
            $tid=$this->request->input('ticket_id');
            DB::select('CALL Transmital(?,?)', [$uid,$tid]);
            $this->result="Success";
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    public function UpdateStatus()
    {
        try {
            $uid=$this->request->input('status');
            $tid=$this->request->input('id');
            DB::select('CALL UpdateTicket(?,?)', [$uid,$tid]);
            $this->result="Status Update Success";
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }


}
