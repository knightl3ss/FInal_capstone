<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'gender',
        'birthday',
        'age',
        'employee_id',
        'email',
        'phone_number',
        'address_street',
        'address_city',
        'address_state',
        'address_postal_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $middleInitial = $this->middle_name ? substr($this->middle_name, 0, 1) . '. ' : '';
        $extension = $this->extension_name ? ' ' . $this->extension_name : '';
        return $this->first_name . ' ' . $middleInitial . $this->last_name . $extension;
    }
} 