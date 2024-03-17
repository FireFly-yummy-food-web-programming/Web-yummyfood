<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Yummy food restaurant";
        return view('admin.dashboard.dashboard', compact('title'));
    }
}