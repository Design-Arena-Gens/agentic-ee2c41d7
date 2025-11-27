<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'role' => UserRole::class,
        ];
    }

    /**
     * Determine if the user has any of the provided roles.
     *
     * @param  array<UserRole|string>  $roles
     */
    public function hasRole(array $roles): bool
    {
        $roleValue = $this->role instanceof UserRole ? $this->role->value : $this->role;

        return collect($roles)
            ->map(fn ($role) => $role instanceof UserRole ? $role->value : $role)
            ->contains($roleValue);
    }

    public function canAccessAdmin(): bool
    {
        return $this->hasRole([
            UserRole::SUPER_ADMIN,
            UserRole::ADMIN,
            UserRole::CONTENT_MANAGER,
        ]);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole([UserRole::SUPER_ADMIN]);
    }
}
