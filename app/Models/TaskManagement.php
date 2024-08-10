<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskManagement extends Model
{
    use HasFactory;

    protected $table      = 'task_managements';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'title',
        'description',
        'due_date',
        'status',
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
