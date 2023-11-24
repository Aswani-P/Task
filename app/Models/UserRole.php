<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class UserRole extends Model
{
    use HasFactory;
    public function getUser(){
        return $this->belongsToMany(User::class, 'user_id');
    }
    public function getRole(){
        return $this->belongsToMany(Role::class, 'role_id');
    }
}
