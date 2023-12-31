<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\User;
use Illuminate\Http\Request;
use Paystack;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'votes' => "required|integer|min:10"
        ]);

        return back()->with('success', 'Votes successfully purchased');
    }

    public function update(Request $request, Vote $vote)
    {

    }

}

