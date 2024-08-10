<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'email',
        'name',
        'password',
    ];

    public function userRole(){
        return $this->hasMany(UserRole::class);
    }

    public function taskManagement(){
        return $this->hasMany(TaskManagement::class);
    }
}
