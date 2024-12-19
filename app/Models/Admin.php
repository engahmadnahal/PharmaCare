<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable,HasRoles;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
}
