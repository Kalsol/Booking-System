<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffMembers = Staff::with('user')->get();
        return Inertia::render('staff/Index', [
            'staffMembers' => $staffMembers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('staff/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_title' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'bio' => 'required|string|max:255',
            'status' => 'required|string|max:255',  
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ]);

        Staff::create([
            'user_id' => $user->id,
            'role_title' => $request->role_title,
            'hourly_rate' => $request->salary,
            'bio' => $request->bio,
            'status' => $request->status,
        ]);

        return redirect()->route('staff.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return Inertia::render('staff/Show', [
            'staff' => $staff,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return Inertia::render('staff/Edit', [
            'staff' => $staff,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([

        ]);

        $staff->update($request->all());

        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index');
    }
}
