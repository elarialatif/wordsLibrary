<?php

namespace App\Http\Controllers\superAdmin;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('superadmin.school.index',compact('schools'));
    }
}
