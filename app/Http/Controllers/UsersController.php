<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render("Users");
    }
    
    public function create()
    {
        return Inertia::render("Create");
    }
}
