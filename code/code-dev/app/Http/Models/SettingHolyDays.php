<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingHolyDays extends Model
{
    use HasFactory;
    protected $table = 'settings_holy_days';
    protected $hidden = ['created_at', 'updated_at'];
}
