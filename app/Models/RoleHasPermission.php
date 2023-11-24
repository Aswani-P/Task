<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class RoleHasPermission extends Model
{
    use HasFactory;
    use HasRoles;
    protected $guarded =[];
    public $timestamps = false;
}
