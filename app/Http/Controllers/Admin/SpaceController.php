<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        return view('admin.spaces.index');
    }

    public function toggleActive(\App\Models\Space $space)
    {
        $space->update(['is_active' => !$space->is_active]);
        return back()->with('success', 'Space status updated.');
    }
}
