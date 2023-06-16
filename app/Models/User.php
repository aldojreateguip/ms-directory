<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    public $timestamps = false;
    protected $table = 'user';
    protected $username = 'user_username';
    protected $guarded = [
        'user_id',
        'user_state',
        'user_created_at' => 'created_at',
        'user_updated_at' => 'updated_at',
    ];
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'email',
        'password',
        'person_id',
    ];
}
