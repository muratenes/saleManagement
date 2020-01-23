<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'started_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'started_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function parentUser()
    {
        return $this->belongsTo(User::class, 'parent', 'id')->orderByDesc('started_at');
    }

    public function directors()
    {
        return $this->hasMany(User::class, 'parent', 'id')->whereHas('roles', function ($query) {
            $query->where('type', Role::ROLE_SALES_DIRECTOR);
        });
    }

    public function representatives()
    {
        return $this->hasMany(User::class, 'parent', 'id')->whereHas('roles', function ($query) {
            $query->where('type', Role::ROLE_SALES_REPRESENTATIVE);
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param string|array $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn(‘name’, $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where(‘name’, $role)->first();
    }
}
