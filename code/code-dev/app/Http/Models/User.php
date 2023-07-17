<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $hidden = ['created_at', 'updated_at'];

    public function area(){
        return $this->hasOne(MaintenanceArea::class,'id','idmaintenancearea');
        
    }
}
