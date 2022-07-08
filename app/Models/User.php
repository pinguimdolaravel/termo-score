<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dailyScores(): HasMany
    {
        return $this->hasMany(DailyScore::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function contactInfo()
    {
        return $this->hasOne(UserContactInfo::class, 'user_id');
    }

    public function teams():BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->withTimestamps()
            ->withPivot(['role']);
    }

    public function teamsThatIOwn()
    {
        return $this->hasMany(Team::class);
    }
}
