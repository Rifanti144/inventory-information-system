<?php

namespace App\Http\Controllers;

class FleetController extends Controller
{
    public function index()
    {
        return view('fleet.index');
    }

    public function create()
    {
        return view('fleet.create');
    }
}
