<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable // implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'type',
        'kantor_id',
        'otorisator',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class);
    }

     /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '.jpg?s=200&d=mm';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Assigning User role
     *
     * @param \App\Models\Role $role
     */
    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            return in_array($this->type, $roles);
        }
        return $this->type === $roles;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isUser()
    {
        return $this->hasRole('user');
    }

    public function isPelayanan()
    {
        return $this->hasRole('pelayanan');
    }

    public function isKredit()
    {
        return $this->hasRole('kredit');
    }

    public function isAkunting()
    {
        return $this->hasRole('akunting');
    }

    public function isUmumPusat()
    {
        return $this->hasRole('umumpst');
    }

    public function isBisnis()
    {
        return $this->hasRole('bisnis');
    }

    public function isSekdir()
    {
        return $this->hasRole('sekdir');
    }

    public function isSkai()
    {
        return $this->hasRole('skai');
    }

    public function isSdm()
    {
        return $this->hasRole('sdm');
    }

    public function isPpk()
    {
        return $this->hasRole('ppk');
    }
}
