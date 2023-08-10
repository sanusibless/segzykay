<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function dashboard()
    {
        $total_vote = Vote::all()->sum('votes');

        $total_revenue = $total_vote * 200; // set this to price per vote

        $active_participants = User::participants()->active()->count();

        $withdrawn_participants = User::participants()->withdrawn()->count();

        return view('admin.dashboard', compact('total_vote', 'total_revenue', 'active_participants', 'withdrawn_participants'));
    }

    public function participants() 
    {
        return view('admin.participants', $this->getParticipants());
    }

    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('admin.login', [
            'app_name' => env('APP_NAME')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => "required|email",
            'password' => "required|string",
        ]);
        if(auth()->attempt($data, request('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success','Login Successful');
        }

        return back()->withErrors(['email', 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    private function getParticipants()
    {
        $active_participants = User::participants()->active()->count();

        $withdrawn_participants = User::participants()->withdrawn()->count();

        return compact('active_participants','withdrawn_participants');
    }
}
