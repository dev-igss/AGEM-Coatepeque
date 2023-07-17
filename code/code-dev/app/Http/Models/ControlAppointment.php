<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlAppointment extends Model
{
    use HasFactory;

    protected $table = 'control_appointments';
    protected $hidden = ['created_at', 'updated_at'];
}
