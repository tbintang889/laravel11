<?php

namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Role extends Model
{
    protected $fillable = ['name'];

    // Definisikan relasi atau metode lain di sini
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
