<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // trait لدعم RBAC

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Attributes المسموح بالتعيين الجماعي (Mass Assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa_secret',      // 2FA secret
        'two_factor_enabled',    // تفعيل 2FA
    ];

    /**
     * Attributes المخفية عند الإرجاع كـ JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret', // لا تظهر سر 2FA
    ];

    /**
     * Attribute casts
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'password' => 'hashed', // Laravel 10+ يدعم Hash تلقائي
    ];
}
