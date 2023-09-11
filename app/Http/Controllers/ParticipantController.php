<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('participants.index', [
            'participants' => User::participants()->active()->get(),
            'title' => 'Contestants'
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

        event(new RegisteredParticipants($user));
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
    public function update(Request $request, User $user)
    {
       $data = $request->validate([
            'firstname' => "required|string",
            'midname' => "required|string",
            'lastname' => "required|string",
            'email' => "nullable|email|unique:users,email",
            'phone' => "required|digits:11",
            'dob' => "required|date",
            'gender' => "nullable",
            'street' => "required_with:city,state|string",
            'city' => "required_with:street,state|string",
            'state' => "required_with:street,city|string",
            'image' => "nullable|image"
       ]);
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('image','public');
        }
        $user->update($data);
        return back()->with('success', 'Participants Updated succefully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
