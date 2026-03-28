<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @var array */
    public $fillable = ['name', 'email', 'password', 'role'];

    /** @var array */
    protected $hidden = ['password'];

    public function jobs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function applications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCompany(): bool
    {
        return $this->role === 'company';
    }
}