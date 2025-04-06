<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'rate_per_day',
        'employment_start',
        'employment_end',
        'source_of_fund',
        'office_assignment',
        'appointment_type',
    ];
}
