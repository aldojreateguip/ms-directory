<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    use HasFactory, HasRoles;
    public $timestamps = false;
    protected $table = 'permission';
    protected $guarded = 'permission_id';
    protected $primaryKey = 'permission_id';

    protected $filliable = [
        'permission_key',
        'permission_description'
    ];
}
