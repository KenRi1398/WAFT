<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;
    public $request;
    public $result;




    public function AddDepartment()
    {

        $name = $this->request->input('name');
        $receiver = $this->request->input('receiver');
        $requester = $this->request->input('requester');
        $branch_id = $this->request->input('branch');
        try {
            $results = DB::select('CALL AddDepartment(?, ?, ?, ?)', [$name, $receiver, $requester, $branch_id]);
            $this->result = "Add Department  Succeed";
        } catch (\Exception $e) {

            $this->result = $e->getMessage();

        }
    }
    public function getDepartment()
    {
        $this->result = self::all();

        return $this->result;
    }
}
