<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User_Role extends Model
{
    use HasFactory, HasRoles;
    public $timestamps = false;
    protected $table = 'user_role';
    protected $guarded = [
        'id',
        'ur_state',
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'user_id',
        'role_id',
    ]; 
}
