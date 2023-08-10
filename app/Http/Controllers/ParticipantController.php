<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;
use App\Http\Requests\StoreParticipantRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('participants.index', [
            'participants' => User::participants()->active()->get(),
            'title' => 'Models'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParticipantRequest $request)
    {
        $participant = $request->validated();
        if($request->hasFile('image')){
            $participant['image'] = $request->file('image')->store('image','public');
        } 

        $user = User::create($participant);

        Vote::create([
            'user_id' => $user->id
        ]);

        return redirect()->route('participants.index')->with('success', 'You are have succefully registered!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('participants.show', [
            'participant' => $user,
            'title' => $user->firstname
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
