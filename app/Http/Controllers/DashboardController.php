<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $dashboard;
    public function Dashboardpage()
    {
        return view('Dashboard/Dashboard')->with('dashboard', $this->dashboard);
    }
}