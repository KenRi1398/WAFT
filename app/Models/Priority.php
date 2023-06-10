<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Priority extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $error;

    public function GetPriority()
    {
       return $results=DB::select('CALL GetPriority()');
    }
}
