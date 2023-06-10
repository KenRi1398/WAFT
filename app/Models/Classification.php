<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classification extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $error;

    public function AddClassification()
    {

        $name = $this->request->input('class_name');
        $description = $this->request->input('description');
        $depid =$this->request->input('department_id')!=null?$this->request->input('department_id'): session()->get("user")->Department_id;
        try {
            $results = DB::select('CALL AddClassification(?, ?, ?)', [$name, $description, $depid]);
            $this->result = "Add Classification  Succeed";
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

        }
    }
     public function GetClassification()
    {
            return $this->result=Self::all();
        
    }
}
