<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Space::query();

        // Filter by Type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by Search (Name or Location)
        if ($request->has('search') && $request->search != '') {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%')
                    ->orWhere('location', 'like', '%' . $term . '%')
                    ->orWhere('sub_location', 'like', '%' . $term . '%');
            });
        }

        $spaces = $query->latest()->get();

        return view('explore', compact('spaces'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Space $space)
    {
        return view('space.show', compact('space'));
    }
}
