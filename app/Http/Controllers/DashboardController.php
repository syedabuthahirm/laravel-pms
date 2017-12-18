<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Project;
use App\Status;

class DashboardController extends Controller
{
    public function index()
    {
        $projectGroupCounts = Status::getProjectsCountByStatus();
        return view('dashboard.index', compact('projectGroupCounts'));
    }
}
