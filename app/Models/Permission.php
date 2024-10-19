<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['permission_id', 'role_id'];

    public function childs()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }
}
