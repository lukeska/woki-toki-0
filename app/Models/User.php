<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function channels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class)
            ->withTimestamps();
    }

    public function currentChannels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class)
            ->join('teams', 'teams.id', '=', 'channels.team_id')
            ->where('teams.id', $this->currentTeam->id)
            ->select('channels.*')
            ->withTimestamps();
    }

    public function belongsToChannel(Channel $channel): bool
    {
        return $this->channels->contains(function ($c) use ($channel) {
            return $c->id === $channel->id;
        });
    }

    public function browsableChannels(): Builder
    {
        return Channel::query()
            ->where('team_id', $this->currentTeam->id)
            ->where(function ($query) {
                $query->where('private', false)
                    ->orWhereHas('users', function ($query) {
                        $query->where('user_id', $this->id);
                    });
            })
            ->withCount('users');
    }
}
