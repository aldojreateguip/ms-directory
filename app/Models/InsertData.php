<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class InsertData extends Model
{
    use HasFactory, HasRoles;
    public static function insertData($data)
    {
        $value = DB::table('ubigeo')->where('');
        if ($value->count() == 0) {
            DB::table('users')->insert($data);
        };
    }
}
