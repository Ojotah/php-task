<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'posts' => post::orderBy('created_at', 'DESC')->paginate(5)
        ]);
    }
}
