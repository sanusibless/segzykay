<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'midname',
        'email',
        'dob',
        'street',
        'city',
        'state',
        'gender',
        'image',
        'phone',
        'role',
        'status',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeParticipants($query) 
    {
        return $query->where('role','participant');
    }

    public function scopeActive($query) 
    {
        return $query->where('status', 'active');
    }

    public function scopeWithdrawn($query) 
    {
        return $query->where('status', 'withdrawn');
    }

    public function getFullNameAttribute() 
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function vote() 
    {
        return $this->hasOne(Vote::class);
    }

    public function getVotesAttribute()
    {
        return $this->vote->votes;
    }

    public function setVotesAttribute($value)
    {
        $this->vote->votes += $value;
        $this->vote->save();
    }

    public function revenue()
    {
        return $this->hasOne(Revenue::class);
    }
}
