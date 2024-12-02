<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $casts = [
        'created_ at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'created_at',
    ];
}
