<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role_Permission extends Model
{
    use HasFactory, HasRoles;
    protected $table = 'role_permission';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];
}
