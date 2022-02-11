<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
    public function index()
    {
        return Inertia::render('Users');
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function posts()
    {
        return Inertia::render('Posts');
    }

    public function createposts()
    {
        return Inertia::render('createPosts');
    }
}
