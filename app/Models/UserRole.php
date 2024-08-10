<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table      = 'user_roles';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'role_id'
    ];


    public function user(){
        $this->belongsTo(User::class);
    }

    public function role(){
        $this->belongsTo(Role::class);
    }
}
