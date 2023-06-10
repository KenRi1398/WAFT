<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department as Department;
use App\Models\Issue as Issue;
use App\Models\Classification as Classification;

class ToolsController extends Controller
{
    private $department;
    private $issue;
    private $classification;
     public function __construct()
    {
        $this->department = new Department;
        $this->issue = new Issue;
        $this->classification = new Classification;

    }

    public function toolsdepartment()
    {

        return view('Tools/AddDepartment')->with('department', $this->department);
    }
    public function toolsclassification()
    {

        return view('Tools/AddClassification')->with('classification', $this->classification)->with('department', $this->department);

    }
    public function toolsissue()
    {

        return view('Tools/AddIssue')->with('classification', $this->classification);

    }

    public function toolspage()
    {

        return view('Tools/Tools');

    }
    public function AddDepartment(Request $request)
    {
        $this->department->request = $request;
        $this->department->AddDepartment();
        return view('Tools/AddDepartment')->with('department', $this->department);

    }
     public function AddIssue(Request $request)
    {

        $this->issue->request = $request;
        $this->issue->AddIssue();
        return view('Tools/AddIssue')->with('issue', $this->issue)->with('classification', $this->classification);

    }
    public function AddClassification(Request $request)
    {
        $this->classification->request = $request;
        $this->classification->AddClassification();
        return view('Tools/AddClassification')->with('classification', $this->classification)->with('department', $this->department);

    }
}
