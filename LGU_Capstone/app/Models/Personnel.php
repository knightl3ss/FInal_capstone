<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnels'; // Ensure this matches your actual table name

    protected $fillable = [
        'office',
        'itemNo',
        'position',
        'salaryGrade',
        'authorizedSalary',
        'actualSalary',
        'step',
        'code',
        'type',
        'level',
        'lastName',
        'firstName',
        'middleName',
        'dob',
        'originalAppointment',
        'lastPromotion',
        'status',
    ];
}
