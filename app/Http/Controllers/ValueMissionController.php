<?php
namespace App\Http\Controllers;

use App\Models\ValueMission;

class ValueMissionController extends Controller
{
    public function index()
    {
        $valueMissions = ValueMission::where('is_active', true)->get();

        return view('values.index', compact('valueMissions'));
    }
}

