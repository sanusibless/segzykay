<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    // Admin Authentication methods
    public function login()
    {
        return view('admin.login', [
            'app_name' => env('APP_NAME')
        ]);
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => ['required',
                        'email',
                    Rule::exists('users')->where(function ($query) {
                      return $query->where('role', 'admin');
                         })
                    ],
            'password' => "required|string",
        ]);
        if(auth()->attempt($data, request('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email', 'Invalid credentials'])->onlyInput('email');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    // Participants methods

    public function participants() 
    {
        return view('admin.participants.index', $this->getParticipants());
    }


    public function participant_edit(User $user) {

        return view('admin.participants.edit', compact('user'));
    } 

    public function participant_withdraw() {
        request()->validate([
            'user_id' => 'required|integer'
        ]);
        $user = User::findOrFail(request('user_id'));
        $user->status = 'withdrawn';
        $user->save();

        return back()->with('success', "Contestant successfully withdrawn!");
    }

    private function getParticipants()
    {
        $active_participants = User::participants()->active();

        $withdrawn_participants = User::participants()->withdrawn();

        return compact('active_participants','withdrawn_participants');
    }

    // Revenue methods

    public function revenue()
    {
        $total_revenue = Revenue::sum('amount');
        $revenues = Revenue::with('user')->paginate(10);
        return view('admin.revenue.index', compact('total_revenue', 'revenues'));
    }
}
