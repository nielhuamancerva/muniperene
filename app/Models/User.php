<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_GAT = 'ROLE_GAT';
    const ROLE_SGTI = 'ROLE_SGTI';
    const ROLE_GPSDH = 'ROLE_GPSDH';
    const ROLE_GIDUR = 'ROLE_GIDUR';
    const ROLE_GDE = 'ROLE_GDE';
    const ROLE_GAF = 'ROLE_GAF';
    const ROLE_GEPPI = 'ROLE_GEPPI';

    private const ROLES_HIERARCHY = [
    self::ROLE_SUPERADMIN => [self::ROLE_ADMIN, self::ROLE_USER],
    self::ROLE_ADMIN => [self::ROLE_USER],
    self::ROLE_USER => [],
    self::ROLE_GAT => []
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isGranted($role)
    {
        return $role === $this->role || in_array($role,
        self::ROLES_HIERARCHY[$this->role]);
    }
}
