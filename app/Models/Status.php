<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $error;

    public function GetStatus()
    {
        
        return $this->result=DB::select('CALL GetsStatus()');
    }



}
