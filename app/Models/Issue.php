<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Issue extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $error;
    public function AddIssue()
    {

        $name = $this->request->input('issue_name');
        $dep_id = $this->request->input('class_id');
      
        try {
            $results = DB::select('CALL AddIssue(?, ?)', [$name, $dep_id]);
            $this->result = "Add Issue  Succeed";
        } catch (\Exception $e) {

            $this->error = $e->getMessage();

        }
    }
    public function GetIssue(){

        return $this->result = Self::all(); 


    }
}
